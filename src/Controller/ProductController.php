<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Service\Order\Basket;
use Service\Product\Product;
use Service\SocialNetwork\ISocialNetwork;
use Service\SocialNetwork\SocialNetwork;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    use Render;

    /**
     * Информация о продукте
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function infoAction(Request $request, $id): Response
    {
        $basket = (new Basket($request->getSession()));

        if ($request->isMethod(Request::METHOD_POST)) {
            $basket->addProduct((int)$request->request->get('product'));
        }

        $productInfo = (new Product())->getInfo((int)$id);

        if ($productInfo === null) {
            return $this->render('error404.html.php');
        }

        $user = (new Security($request->getSession()));
        if($user->isLogged())
        {
            $productInfo = (new Product())->calculate($user->getUser()->getDiscount(), $productInfo);
        }
        $isInBasket = $basket->isProductInBasket($productInfo->getId());

        return $this->render('product/info.html.php', ['productInfo' => $productInfo, 'isInBasket' => $isInBasket]);
    }

    /**
     * Список всех продуктов
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $user = (new Security($request->getSession()));
        $productList=[];
        if(!$user->isLogged()) {
            $productList = (new Product())->getAll($request->query->get('sort', ''));
        }else{
            $productList = (new Product())->calculateAll($request->query->get('sort', ''),$user->getUser()->getDiscount());
        }
        return $this->render('product/list.html.php', ['productList' => $productList]);
    }

    /**
     * Публикация сообщения в соц.сети
     *
     * @param Request $request
     * @param string $network
     *
     * @return Response
     */
    public function postAction(Request $request, string $network): Response
    {
        $courseName = $request->query->get('course', '');
        (new SocialNetwork())->create($network, $courseName);

        return $this->redirect('product_info', ['id' => $request->query->get('page_num', 1)]);
    }
}
