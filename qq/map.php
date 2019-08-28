<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php ActiveForm::begin(['action'=>['qq/showmap']]); ?>

    <?= Html::input('text','address') ?>

   
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>