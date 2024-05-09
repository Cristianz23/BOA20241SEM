<?php
    require_once 'models/expensesmodel.php';
    require_once 'models/categoriasmodel.php';
    class Dashboard extends SessionController{

        private $user;
        function __construct()
        {
            parent::__construct();
            $this->user = $this->getUserSessionData();
            error_log('Dashboard::construct-> Inicio de Dashboard');
        }

        function render(){
            error_log('Dashboard::render-> Cargo Dashboard');
            $expensesModel = new ExpensesModel();
            $expenses = $this->getExpenses(5);
            $totalThisMonth = $expensesModel->getTotalAmountThisMonth($this->user->getId());
            $maxExpensesThisMonth = $expensesModel->getMaxExpensesThisMonth($this->user->getId());
            $categories = $this->getCategorias();

            $this->view->render('dashboard/index', [
                'user' => $this->user,
                'totalAmountThisMonth' => $totalThisMonth,
                'maxExpensesThisMonth' => $maxExpensesThisMonth,
                'categories' => $categories
            ]);
        }

        public function getExpenses($n = 0){
            if($n < 0) return null;

            $expenses = new ExpensesModel();
            return $expenses -> getByUserIdAndLimit($this->user->getId(), $n);
        }

        public function getCategorias(){
            $res = [];
        $categoriesModel = new CategoriesModel();
        $expensesModel = new ExpensesModel();

        $categories = $categoriesModel->getAll();

        foreach ($categories as $category) {
            $categoryArray = [];
            //obtenemos la suma de amount de expenses por categoria
            $total = $expensesModel->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            // obtenemos el número de expenses por categoria por mes
            $numberOfExpenses = $expensesModel->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());
            
            if($numberOfExpenses > 0){
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numberOfExpenses;
                $categoryArray['category'] = $category;
                array_push($res, $categoryArray);
            }
            
        }
        return $res;

        }
       
    }
?>