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

                            <v-btn style="width: -webkit-fill-available; margin-bottom: 15px;" class="load-content-button btn btn-primary" @click="moveTodoDetail(item.id)">コンテンツを読み込む</v-btn>
                            <v-btn style="width: -webkit-fill-available; margin-bottom: 15px;" @click="createTodo" color="blue-accent-2">コメントする</v-btn>
                            <!--<v-btn @click="deleteTodo" density="compact" color="red">削除</v-btn>-->
                            
                            <span style="width: -webkit-fill-available; margin-bottom: 15px;" v-for="(comment, commentIndex) in commentList" :key="'comment' + commentIndex">
                                <p style="background-color: burlywood; width: -webkit-fill-available; margin-bottom: 15px;" v-if="comment.article_id === item.id">{{ comment.user_id }} {{ comment.comment }}</p>
                            </span>
                            
                        </td>
                    </tr>
                </tbody>
            </v-table>
            
        </div>
        
    </v-container>

    <div>
    <h4>Comment List</h4>
    <ul>
        <li v-for="(item, index) in commentList" :key="'comment' + index">
            <p>{{ item.id }} {{ item.article_id }} {{ item.user_id }} {{ item.comment }}</p>
        </li>
    </ul>
    </div>
    
    <div class="mt-5">
            <v-row>
                <v-col cols="10"></v-col>
                <v-col cols="1">
                    
                </v-col>
            </v-row>
        </div>

</template>

<script setup>
import {ref, onMounted} from 'vue'
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

//詳細に遷移(新規モード)
const createTodo = () => {
    //router.push({name:'detail'})
}




</script>