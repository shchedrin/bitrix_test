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
            <div class="col-xs-3">
                <div class="input-group">
                     <span class="input-group-btn">
                        <button @click="deleteRow(index)" class="btn btn-secondary" type="button">X</button>
                    </span>
                    <input @change="getData(index)" v-model="good.xmlId" type="text" class="form-control" placeholder="XML_ID">
                </div>
            </div>
            <div class="col-xs-9" v-if="!good.loading">
                <div v-if="good.params.name != undefined">
                    <div class="col-xs-3">
                        <a href="#">
                            <img style="height: 160px" :src="good.params.picture"/>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <h2>{{good.params.name}}</h2>
                        <p>
                            <span>Артикул: {{good.params.artnumber}}</span><br>
                            <span>Цвет: {{good.params.color}}</span><br>
                            <span>Размер: {{good.params.size}}</span>
                        </p>
                    </div>
                </div>
                <div v-if="good.params.name == undefined">
                    Товар не найден
                </div>
            </div>
        </div>
    </template>

    <button @click="addRow()" id="addXmlField" type="button" class="btn btn-primary">Добавить поле</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.22/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            goods: [
                {
                    loading: true,
                    xmlId: '',
                    params: {
                        name: '',
                        artnumber: '',
                        picture: '',
                        color: '',
                        size: ''
                    },
                }
            ]
        },
        methods: {
            addRow() {
              this.goods.push({
                  loading: true,
                  xmlId: '',
                  params: {
                      name: '',
                      artnumber: '',
                      picture: '',
                      color: '',
                      size: ''
                  },
              });
            },
            deleteRow(index) {
                this.goods.splice(index, 1);
            },
            getData(index) {
                axios.get('/local/getByXmlId.php?XML_ID='+this.goods[index].xmlId)
                    .then((response) => {
                        this.goods[index].params.name = response.data.NAME;
                        this.goods[index].params.artnumber = response.data.ARTNUMBER;
                        this.goods[index].params.picture = response.data.PICTURE;
                        this.goods[index].params.color = response.data.COLOR_REF;
                        this.goods[index].params.size = response.data.SIZES_CLOTHES;
                        this.goods[index].loading = false;
                    });
            }

        }
    })
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");