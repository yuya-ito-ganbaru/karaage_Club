import { createRouter, createWebHistory} from "vue-router";
import home from "../views/Home.vue"
import detail from "../views/Detail.vue"

const routes = [
    {
        path:"/sample",
        component:home,
        name:"home"
    },
    {
        path:"/sample/detail/:todoId?",
        component:detail,
        name:"detail",
        props:true
    },
]

const router = createRouter({
    history:createWebHistory(import.meta.env.BASE_URL),
    routes:routes
})

export default router