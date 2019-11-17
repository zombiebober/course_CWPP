<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        $product = new Entity\Product(0, '', 0, '');
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $product->setId($item['id']);
            $product->setPrice($item['price']);
            $product->setName($item['name']);
            $product->setDescription($item['description']);
            $productList[] = clone $product;
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        $product = new Entity\Product(0, '', 0, '');
        foreach ($this->getDataFromSource() as $item) {
            $product->setId($item['id']);
            $product->setPrice($item['price']);
            $product->setName($item['name']);
            $product->setDescription($item['description']);
            $productList[] = clone $product;
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
                'description' => 'скриптовый язык общего назначения, интенсивно применяемый для разработки веб-приложений',
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
                'description' => 'высокоуровневый язык программирования общего назначения, ориентированный на повышение производительности разработчика и читаемости кода'
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
                'description' => 'результат скрещивания Java, С++ и Delphi c элементами функциональщины. Медленно, но верно, превращается в самый упоротый из промышленных языков (хотя до C++ ему ещё далеко).'
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
                'description' => 'JAVA JAVA FOREVER'
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
                'description' => 'тот же Python, только с принудительным ООП и парой-тройкой дополнительных свистоперделок. В своё время взлетел исключительно благодаря рельсам и, собственно, сейчас без них никому не упал.'
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
                'description' => "да-да, так называется не только среда, но и сам язык, причём с версии 7 — официально™. По сути своей — Pascal с классами. Некогда был дико популярен для клепания десктопных оконных приложений, так как среда разработки позволяла чуть ли не программировать мышкой, однако на данный момент практически умер, ибо с развитием интернетов оконные приложения стали гораздо менее востребованными, а те, кому они все-таки нужны, используют решетки. "
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
                'description' => "surprise! То, что С++ приемлем для быдлокодеров, уже давно известно, в том числе и Линусу Торвальдсу. Очень популярен, всем известен, есть много IDE для программирования мышкой. Нуфф саид. "
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
                'description' => "язык программирования, разработанный придуманный по приколу в пиндосской компании Bell Labs в начале 1970-х годов Деннисом Ритчи. "
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
                'description' => " скриптовый язык, напоминающий C. Используется в некоторых играх (wow, например) и эмуляторах для реализации ИИ и пр. хрени. Грядет на замену убогим шаблонам MediaWiki, в Википедиях уже доступен."
            ],
            [
                'id' => 12,
                'name' => 'Rust',
                'price' => 12000,
                'description' => "всё, хватит. Кто в 16 лет не мечтал запилить свой язык программирования, который наконец-то позволит писать всё и сразу, у того нет сердца."
            ]
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
