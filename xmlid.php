<?php
/**
 * Created by PhpStorm.
 * User: i.shchedrin
 * Date: 27.01.2019
 * Time: 16:55
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление товаров по коду");?>
<div id="app">
    <template v-for="(good, index) in goods">
        <div class="row form-group">
            <div class="col-xs-3 input-group">
                <span class="input-group-btn">
                    <button @click="deleteRow(index)" class="btn btn-secondary" type="button">X</button>
                </span>
                <input v-model="good.xmlId" type="text" class="form-control" placeholder="XML_ID">
            </div>
            <div class="col-xs-9"></div>
        </div>
    </template>

    <button @click="addRow()" id="addXmlField" type="button" class="btn btn-primary">Добавить поле</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.22/dist/vue.js"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            goods: [
                {
                    xmlId: '',
                }
            ]
        },
        methods: {
            addRow() {
              this.goods.push({});
            },
            deleteRow(index) {
                this.goods.splice(index, 1);
            }
        }
    })
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");