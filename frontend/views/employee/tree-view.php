<?php

use yii\helpers\Html;
use common\models\Employee;
?>
<html>
    <head>
        <title>HTML &amp; CSS tree</title>

        <!-- tree -->
        <style type="text/css">
            ul.tree {
                overflow-x: auto;
                white-space: nowrap;
            }
            ul.tree,
            ul.tree ul {
                width: auto;
                margin: 0;
                padding: 0;
                list-style-type: none;
            }
            ul.tree li {
                display: block;
                width: auto;
                float: left;
                vertical-align: top;
                padding: 0;
                margin: 0;
            }
            ul.tree ul li {
                background-image: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=);
                background-repeat: repeat-x;
                background-position: left top;
            }
            ul.tree li span {
                display: block;
                width: 5em;
                /*
                  uncomment to fix levels
                  height: 1.5em;
                */
                margin: 0 auto;
                text-align: center;
                white-space: normal;
                letter-spacing: normal;
            }
        </style>
        <!--[if IE gt 8]> IE 9+ and not IE -->
        <style type="text/css">
            ul.tree ul li:last-child {
                background-repeat: no-repeat;
                background-size:50% 1px;
                background-position: left top;
            }
            ul.tree ul li:first-child {
                background-repeat: no-repeat;
                background-size: 50% 1px;
                background-position: right top;
            }
            ul.tree ul li:first-child:last-child {
                background: none;
            }
            ul.tree ul li span {
                background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
                background-size: 1px 0.8em;
                padding-top: 1.2em;
            }
            ul.tree ul {
                background: url(data:image/gif;base64,R0lGODdhAQABAIABAAAAAP///ywAAAAAAQABAAACAkQBADs=) no-repeat 50% top;
                background-size: 1px 0.8em;
                margin-top: 0.2ex;
                padding-top: 0.8em;
            }
        </style>
        <!-- <[endif]-->
        <!--[if lte IE 8]>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script type="text/javascript">
            /* Just to simplify HTML for the moment.
             * This could easily be replaced by inline classes.
             */
            $(function() {
              $('li:first-child').addClass('first');
              $('li:last-child').addClass('last');
              $('li:first-child:last-child').addClass('lone');
            });
        </script>
        <style type="text/css">
        ul.tree ul li {
          background-image: url(pixel.gif);
        }
        ul.tree ul li.first {
          background-image: url(left.gif);
          background-position: center top;
        }
        ul.tree ul li.last {
          background-image: url(right.gif);
          background-position: center top;
        }
        ul.tree ul li.lone {
          background: none;
        }
        ul.tree ul li span {
          background: url(child.gif) no-repeat 50% top;
          padding-top: 14px;
        }
        ul.tree ul {
          background: url(child.gif) no-repeat 50% top;
          margin-top: 0.2ex;
          padding-top: 11px;
        }
        </style>
        <[endif]-->

        <!-- page presentation -->
        <style type="text/css">
            body {
                font-family:sans-serif;
                color: #666;
                text-align: center;
            }
            A, A:visited, A:active {
                color: #c00;
                text-decoration: none;
            }

            A:hover {
                text-decoration: underline;
            }
            ul.tree,
            #wrapper {
                width: 960px;
                margin: 0 auto;
            }
            ul.tree {
                width: 650px;
            }
            .clearer {
                clear: both;
            }
            p {
                margin-top: 2em;
            }
            .add-btns{
                border: 2px solid #009cd9;
                padding: 0px 4px;
                border-radius: 50%;
                color: white;
                background: #009cd9;
            }
            .vacant-btns{
                border: 2px solid #009cd9;
                padding: 0px 6px;
                border-radius: 50%;
                color: #009cd9;
                background: #009cd9;
            }
            .tree-child{
                color: black !important;
            }
            .tree-child:hover{
                text-decoration: none;
            }
            .btn.btn-icon-standalone span {
                padding: 0px;
            }
            .btn {
                margin-left: 15px;
                padding: 3px 12px;
            }
        </style>
    </head>
    <body>
        <i class="fa fa-user" style="color:black;"></i>
        <div id="wrapper" style="margin-top: 100px;">
            <?= Html::beginForm(['employee/tree-search'], 'post') ?>
            <table style="margin: 0 auto;margin-bottom: 30px;">
                <tr>
                    <td><h4 style="text-align: left;">Distributor ID : </h4></td>
                    <td><input type="text" value="<?= $emp_details->user_name ?>" name="distributor_name" class="form-control" style="height:28px;"/></td>
                    <td> <?= Html::submitButton('<span>Search</span>', ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?></td>
                </tr>
            </table>
            <?= Html::endForm() ?>
            <ul class="tree">
                <li>
                    <?php
                    $subchild1_right = 0;
                    $subchild1_left = 0;
                    $subchild2_right = 0;
                    $subchild2_left = 0;
                    $subchild3_right = 0;
                    $subchild3_left = 0;
                    if (!empty($emp_details)) {
                        ?>
                        <span><?= $emp_details->distributor_name ?><br/><?= $emp_details->user_name ?></span>
                        <?php
                        ?>
                        <ul>
                            <?php
                            $emp_child1_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_details->id])->one();
                            $emp_child1_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_details->id])->one();
                            ?>
                            <li>
                                <?php
                                if (!empty($emp_child1_left)) {
                                    $subchild1_left = 1;
                                    ?>
                                    <?= Html::a('<span>' . $emp_child1_left->distributor_name . '<br/>' . $emp_child1_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id)], ['class' => 'tree-child']) ?>
                                    <ul>
                                        <?php
                                        $emp_subchild1_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_child1_left->id])->one();
                                        $emp_subchild1_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_child1_left->id])->one();
                                        ?>
                                        <li>
                                            <?php
                                            if (!empty($emp_subchild1_left)) {
                                                $subchild2_left = 1;
                                                ?>
                                                <?= Html::a('<span>' . $emp_subchild1_left->distributor_name . '<br/>' . $emp_subchild1_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <?php
                                                    $emp_subchild3_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild1_left->id])->one();
                                                    $emp_subchild3_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild1_left->id])->one();
                                                    ?>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild3_left)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild3_left->distributor_name . '<br/>' . $emp_subchild3_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_left->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild3_right)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild3_right->distributor_name . '<br/>' . $emp_subchild3_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_right->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                </ul>
                                            <?php } else {
                                                ?>
                                                <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if (!empty($emp_subchild1_right)) {
                                                $subchild2_right = 1;
                                                ?>
                                                <?= Html::a('<span>' . $emp_subchild1_right->distributor_name . '<br/>' . $emp_subchild1_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <?php
                                                    $emp_subchild4_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild1_right->id])->one();
                                                    $emp_subchild4_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild1_right->id])->one();
                                                    ?>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild4_left)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild4_left->distributor_name . '<br/>' . $emp_subchild4_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild4_left->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild4_right)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild4_right->distributor_name . '<br/>' . $emp_subchild4_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild4_right->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                </ul>
                                            <?php } else {
                                                ?>
                                                <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                    </ul>
                                    <?php
                                } else {
                                    ?>
                                    <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_details->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                    <ul>
                                        <li>
                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                            <?php if ($subchild1_left == 0) { ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                        <li>
                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                            <?php if ($subchild1_left == 0) { ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                    </ul>
                                <?php }
                                ?>
                            </li>
                            <li>
                                <?php
                                if (!empty($emp_child1_right)) {
                                    $subchild1_right = 1;
                                    ?>
                                    <?= Html::a('<span>' . $emp_child1_right->distributor_name . '<br/>' . $emp_child1_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id)], ['class' => 'tree-child']) ?>
                                    <ul>
                                        <?php
                                        $emp_subchild2_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_child1_right->id])->one();
                                        $emp_subchild2_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_child1_right->id])->one();
                                        ?>
                                        <li>
                                            <?php
                                            if (!empty($emp_subchild2_left)) {
                                                $subchild3_left = 1;
                                                ?>
                                                <?= Html::a('<span>' . $emp_subchild2_left->distributor_name . '<br/>' . $emp_subchild2_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_left->id)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <?php
                                                    $emp_subchild5_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild2_left->id])->one();
                                                    $emp_subchild5_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild2_left->id])->one();
                                                    ?>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild5_left)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild5_left->distributor_name . '<br/>' . $emp_subchild5_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild5_left->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild5_right)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild5_right->distributor_name . '<br/>' . $emp_subchild5_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild5_right->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                </ul>
                                            <?php } else {
                                                ?>
                                                <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                <?php if ($subchild3_left == 0) { ?>
                                                    <ul>
                                                        <li>
                                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                        </li>
                                                        <li>
                                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                        </li>
                                                    </ul>
                                                <?php }
                                                ?>
                                            <?php }
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            if (!empty($emp_subchild2_right)) {
                                                $subchild3_right = 1;
                                                ?>
                                                <?= Html::a('<span>' . $emp_subchild2_right->distributor_name . '<br/>' . $emp_subchild2_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild2_right->id)], ['class' => 'tree-child']) ?>
                                                <ul>
                                                    <?php
                                                    $emp_subchild6_right = Employee::find()->where(['placement' => 1, 'placement_name' => $emp_subchild2_right->id])->one();
                                                    $emp_subchild6_left = Employee::find()->where(['placement' => 2, 'placement_name' => $emp_subchild2_right->id])->one();
                                                    ?>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild6_left)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild6_left->distributor_name . '<br/>' . $emp_subchild6_left->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild6_left->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_left->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 2)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php
                                                        if (!empty($emp_subchild6_right)) {
                                                            ?>
                                                            <?= Html::a('<span>' . $emp_subchild6_right->distributor_name . '<br/>' . $emp_subchild6_right->user_name . '</span>', ['tree', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild6_right->id)], ['class' => 'tree-child']) ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_subchild3_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                        <?php }
                                                        ?>
                                                    </li>
                                                </ul>
                                            <?php } else {
                                                ?>
                                                <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_child1_right->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                                <?php if ($subchild3_right == 0) { ?>
                                                    <ul>
                                                        <li>
                                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                        </li>
                                                        <li>
                                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                        </li>
                                                    </ul>
                                                <?php }
                                                ?>
                                            <?php }
                                            ?>
                                        </li>
                                    </ul>
                                <?php } else {
                                    ?>
                                    <?= Html::a('<span><b class="add-btns">+</b><br/>Join Here</span>', ['create', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $emp_details->id), 'type' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', 1)], ['class' => 'tree-child']) ?>
                                    <ul>
                                        <li>
                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                            <?php if ($subchild1_right == 0) { ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                        <li>
                                            <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                            <?php if ($subchild1_right == 0) { ?>
                                                <ul>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                    <li>
                                                        <span><b class="vacant-btns">.</b><br/>Vacant</span>
                                                    </li>
                                                </ul>
                                            <?php }
                                            ?>
                                        </li>
                                    </ul>
                                <?php }
                                ?>
                            </li>
                        </ul>

                    <?php }
                    ?>
                </li>
            </ul>
            <div class="clearer"></div>
        </div>
    </body>
</html>