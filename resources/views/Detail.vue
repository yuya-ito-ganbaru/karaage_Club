<template>
    <v-container>
        <h4 class="mb-5">記事詳細</h4>
        <div class="input-form">
            <v-row>
                <v-col cols="2" style="text-align: right; vertical-align: middle;">
                    タイトル:
                </v-col>
                <v-col cols="4">
                    <v-card-text class="inner-text">{{ todoDetail.title }}</v-card-text>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="2" style="text-align: right;">
                    ステータス:
                </v-col>
                <v-col cols="3">
                    <v-card-text class="inner-text">{{ todoDetail.tag }}</v-card-text>
                </v-col>
            </v-row>
            <!-- 画像表示 -->
            <v-row>
                <v-col cols="2" style="text-align: right; vertical-align: middle;">
                    画像:
                </v-col>
                <v-col cols="3">
                    <img class="img-fluid rounded mb-5 mb-lg-0" :src="`/storage/article_images/${todoDetail.image}`" alt="..." />
                </v-col>
            </v-row>
        </div>
        <div class="mt-5">
            <v-row>
                <v-col cols="5">
                    <v-btn to="/sample" color="blue-grey-lighten-4">戻る</v-btn>
                </v-col>
                <v-col cols="2">
                    <v-btn v-if='props.todoId == null' @click="createTodo" color="blue-accent-2">新規作成</v-btn>
                    <v-btn v-else @click="updateTodo" color="blue-accent-2">更新</v-btn>
                </v-col>
            </v-row>
        </div>
    </v-container>
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
