<?php

namespace app\controllers;

use Yii;
use app\models\Conversao;
use app\models\ConversaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConversaoController implementa as ações do CRUD do model.
 */
class ConversaoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Exibe todas as conversões realizadas.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConversaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Retorna a cotacao da moeda para a view via ajax
     * 
     * @param string $moeda abreviação da moeda (code)
     *
     * @return float
     */
    public function actionCotacaoAtual($moeda)
    {
        $this->layout = false;
        $cotacaoMoeda = Conversao::getCotacaoMoeda($moeda);
        
        return $cotacaoMoeda;
    }
    
    /**
     * Retorna o valor convertido e o total de taxas via ajax
     * 
     * @param float $valororigem valor em BRL que será convertido
     * @param float $cotacaoatual cotação da moeda escolhida
     * @param string $formadepagamento forma de pagamento Boleto ou Cartão para
     * que seja calculada a taxa
     *
     * @return json
     */
    public function actionValorConvertido($valororigem, $cotacaoatual, $formadepagamento)
    {
        $this->layout = false;
        $model = new Conversao();
        $model->valororigem = $valororigem;
        $model->cotacaoatual = $cotacaoatual;
        $model->formadepagamento = $formadepagamento;
        
        $valor = number_format($model->calcularValorConvertido(), 2, '.', '');
        $taxas = number_format(($model->calcularTaxaPagamento() + $model->calcularTaxaConversao()), 2, '.', '');
        
        return json_encode(['valor' => $valor, 'taxas' =>$taxas]);
    }

    /**
     * Exibe os detalhes de uma conversão.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException se esse modelo não for encontrado
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Exibe a tela para conversão e salva após preenchida e válida.
     * Se a conversão ocorrer normalmente, exibe os detalhes na view
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Conversao();
        $model->moedaorigem = 'BRL';
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaMoedas' => $model->getMoedas(),
            'listaFormaPagamento' => $model->getFormaPagamento()
        ]);
    }

    /**
     * Deleta uma conversão existente
     * If o registro for apagado exibe a tela inidical
     * 
     * @param int $id ID
     * 
     * @return \yii\web\Response
     * 
     * @throws NotFoundHttpException se a conversão não for encontrada
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Encontra o modelo Conversao com base no valor de sua chave primária.
     * Se o modelo não for encontrado, uma exceção 404 HTTP será lançada.
     * 
     * @param int $id ID do model
     * 
     * @return Conversao o modelo populado
     * 
     * @throws NotFoundHttpException Se o model não for encontrado
     */
    protected function findModel($id)
    {
        if (($model = Conversao::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A requisição não existe.'));
    }
}
