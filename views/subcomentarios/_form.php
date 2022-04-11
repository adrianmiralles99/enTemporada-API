<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subcomentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcomentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_comentarioprinc')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'V' => 'V', 'I' => 'I', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
