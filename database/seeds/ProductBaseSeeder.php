<?php

use App\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Repositories\ProductRepository;
use App\Repositories\StatusRepository;

class ProductBaseSeeder extends Seeder
{
    /**
     * Access to User Repository
     */
    protected $productRepository;
    protected $statusRepository;
    protected $lettersBase = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
    protected $productBase = [
        'name' => 'Produto',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ultrices, ante ut maximus condimentum, metus neque posuere nisl, id tristique sem neque hendrerit nibh. Integer placerat, nisi et rutrum sollicitudin, ipsum arcu lobortis leo, pretium hendrerit nunc ipsum ut ante. Nam at eros in nisl mollis tincidunt porttitor quis orci. Aenean sit amet risus turpis. Phasellus eu pellentesque leo. Vestibulum non nibh ut arcu tincidunt tincidunt ut eget ligula. Duis at lacinia nisl. Maecenas nisl eros, tempor et interdum quis, lacinia a odio. Suspendisse vitae scelerisque lectus, ac accumsan est.',
        'image' => 'img/products/product',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository, StatusRepository $statusRepository)
    {
        $this->productRepository = $productRepository;
        $this->statusRepository = $statusRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productTable = $this->productRepository->all();
        $status = $this->statusRepository->filterByRef(Product::getTableName(), ['enable' => 1, 'status' => 1])->first();
        $user = User::first();
        if ($productTable->count() == 0) {
            $count = 1;
            foreach ($this->lettersBase as $letter) {
                $temp = $this->productBase;
                $temp['name'] .= ' ' . $letter;
                $temp['image'] .= $count.'.png';
                $temp['price'] = abs(rand(0,1000000)/10000);
                $temp['status_id'] = $status->id;
                $temp['user_id'] = $user->id;
                $createProductes = $this->productRepository->create($temp);
                $count++;
                if ($count == 5) {
                    $count = 1;
                }
            }
            echo '-> Product Padrão Adicionados com Sucesso!' . PHP_EOL;
        } else {
            echo '-> Product Padrão não foi adicionado devido tabela não estar vazia!' . PHP_EOL;
        }
    }
}