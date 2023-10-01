<template>
    <div class="container px-5 my-5">
      <div class="row gx-5"  style="justify-content: center;">
        <!-- Post content -->
        <article class="col-md-8" style="display: flex;">
          <!-- Preview image figure -->
          <div style="width: 100%; height: 0; position: relative;">
            <figure class="mb-4"><img class="img-fluid rounded" :src="'/storage/article_images/' + todoDetail.image" alt="..." /></figure>
            <div class="review">
              <div class="stars stars_conf">
                <p>おすすめ度</p>
                <span>
                  <input id="review01" type="radio" name="recommend" value="5" :checked="todoDetail.recommend === 5" />
                  <label for="review01">★</label>
                  <input id="review02" type="radio" name="recommend" value="4" :checked="todoDetail.recommend === 4" />
                  <label for="review02">★</label>
                  <input id="review03" type="radio" name="recommend" value="3" :checked="todoDetail.recommend === 3" />
                  <label for="review03">★</label>
                  <input id="review04" type="radio" name="recommend" value="2" :checked="todoDetail.recommend === 2" />
                  <label for="review04">★</label>
                  <input id="review05" type="radio" name="recommend" value="1" :checked="todoDetail.recommend === 1" />
                  <label for="review05">★</label>
                </span>
              </div>
            </div>
          </div>
  
          <!-- Post content -->
          <section style="width: 100%;" class="mb-5">
            <div style="width: 100%;" class="p-6 text-gray-900">
              <div style="border-bottom: 1px solid #d1cfcf;">
                <p class="fs-5 mb-4">{{ todoDetail.title }}</p>
              </div>
              <div style="margin-top: 2%; border-bottom: 1px solid #d1cfcf;">
                <p class="fs-5 mb-4">{{ todoDetail.tag }}</p>
              </div>
              <div style="margin-top: 2%; border-bottom: 1px solid #d1cfcf;">
                <label>ここどこ？</label>
                <p class="fs-5 mb-4">{{ todoDetail.store }}</p>
                <p class="fs-5 mb-4">{{ todoDetail.address }}</p>
              </div>
              <div style="margin-top: 2%; border-bottom: 1px solid #d1cfcf; min-height: 350px;" class="form-floating">
                <p class="fs-5 mb-4">{{ todoDetail.body }}</p>
              </div>
            </div>
          </section>
        </article>
      </div>
    </div>
    <div class="mt-5" style="padding-left: 150px;">
    <v-row>
        <v-col cols="5">
            <v-btn to="/" color="blue-grey-lighten-4">戻る</v-btn>
        </v-col>
    </v-row>
    </div>
  </template>

<script setup>
// /Users/yuya/Desktop/karaage_club/karaage_Club/public/images/karaage.png
// /images/karaage.png
// /Users/yuya/Desktop/karaage_club/karaage_Club/storage/app/public/article_images
// ./storage/app/public/article_images/karaage.png
import {ref,onMounted} from 'vue'
//前画面から(ホームからIDを受け取る)
const props = defineProps({
    todoId:String
})

//データ取得
const todoDetail = ref({title:'', tag:'', created_at:'', image:'' })
if(props.todoId != null) {
    onMounted(async () => {
        var res = await axios.post('getTodo', props)
        if (res.data != undefined) {
            todoDetail.value = res.data[0]
        }
    })
}
///Users/yuya/Desktop/karaage_club/karaage_Club/storage/app/public/article_images

//更新
const updateTodo = async () => {
    //情報にIDをつける
    todoDetail.ID = props.todoId
    await axios.post('updateTodo', todoDetail.value)
}

//新規作成
const createTodo = async () => {
    await axios.post('createTodo', todoDetail.value)
}
</script>

<style>
.input-form {
    font-size: 14px;
}

.inner-text input {
    padding: 0px 2px 0px 2px;
    min-height: 20px;
    font-size: 10px !important;
}
</style>
