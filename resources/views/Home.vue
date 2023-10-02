<template>
    <v-container fluid>
        <h4 class="mb-5">記事一覧</h4>
        <div class="table-list">
            <v-table density="compact">
                <tbody>
                    <tr v-for="(item, index) in todoList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td style="flex-grow: 1; width: 100%;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div style="width: 100%;">
                                    <img style=" margin: 0 auto; max-height: 350px; min-height: 250px;" :src="'/storage/article_images/' + item.image" alt="画像" @click="moveTodoDetail(item.id)" />
                                </div>
                                <div style="width: 50%;">
                                    <div>
                                        <p>{{ item.id }}</p>
                                        <p>{{ item.title }}</p>
                                        <p>{{ item.tag }}</p>
                                        <p>{{ item.body }}</p>
                                        <div class="review">
                                            <div class="stars stars_conf">
                                                <span>
                                                    <input :id="'review' + item.id + '01'" type="radio" :name="'recommend' + item.id" value="5" :checked="item.recommend === 5" />
                                                    <label :for="'review' + item.id + '01'">★</label>
                                                    <input :id="'review' + item.id + '02'" type="radio" :name="'recommend' + item.id" value="4" :checked="item.recommend === 4" />
                                                    <label :for="'review' + item.id + '02'">★</label>
                                                
                                                    <input :id="'review' + item.id + '03'" type="radio" :name="'recommend' + item.id" value="3" :checked="item.recommend === 3" />
                                                    <label :for="'review' + item.id + '03'">★</label>
                                                
                                                    <input :id="'review' + item.id + '04'" type="radio" :name="'recommend' + item.id" value="2" :checked="item.recommend === 2" />
                                                    <label :for="'review' + item.id + '04'">★</label>
                                                
                                                    <input :id="'review' + item.id + '05'" type="radio" :name="'recommend' + item.id" value="1" :checked="item.recommend === 1" />
                                                    <label :for="'review' + item.id + '05'">★</label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <v-btn style="width: -webkit-fill-available; margin-bottom: 15px;" class="load-content-button btn btn-primary" @click="moveTodoDetail">コンテンツを読み込む</v-btn>
                            <div class="flex-container">
                                <div style="width: 100%;">
                                    <v-col>
                                        <v-text-field height="150px" width="150px" density="compact" hide-details variant="solo" class="inner-text" v-model="commentText"></v-text-field>
                                    </v-col>
                                    <v-btn @click="postComment(item.id)" color="blue-accent-2" style="width: -webkit-fill-available; margin: 0 10px; margin-bottom: 15px;">新規コメント</v-btn>
                                </div>

                                <div style="width: 100%;">
                                    <p>コメント表示部分</p>
                                    <span style="width: -webkit-fill-available; margin-bottom: 15px;" v-for="(comment, commentIndex) in commentList" :key="'comment' + commentIndex">
                                    <p style="background-color: burlywood; width: -webkit-fill-available; margin-bottom: 15px;" v-if="comment.article_id === item.id">{{ comment.user_id }} {{ comment.comment }}</p>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </v-table>
            
        </div>
    </v-container>
</template>

<script setup>

import {reactive,defineEmits,ref, onMounted} from 'vue'

import {useRouter} from 'vue-router'



//一覧取得
const todoList = ref([])
onMounted(async () => {
    var res = await axios.get('getTodoList')
    todoList.value = res.data
})

//コメント表示
const commentList = ref([])
onMounted(async () => {
    var res = await axios.get('getCommentList')
    commentList.value = res.data
})

//詳細に遷移(更新)
const router = useRouter()
const moveTodoDetail = (todoId) => {
    router.push({name: 'detail', params:{todoId:todoId}})
}

const commentText = ref('');
// 詳細に遷移(新規モード)
const postComment = async (itemId) => {
    console.log('article_id:', itemId)
    console.log('コメント:',commentText.value)
    const response = await axios.post('postComment', {
            comment: commentText.value,
            article_id: itemId
        });

}



</script>

<style>
/* App.vue と同じディレクトリにある styles.css というCSSファイル */
.flex-container {
  display: flex;
}
</style>