import Vue from 'vue';
import Router from 'vue-router'
import Todo from './components/Todo.vue'

Vue.use(Router)

const routes = [
    {
        path: '/:filter',
        name: 'todo',
        component: Todo,
        props: true
    }
]

const router = new Router({
    scrollBehavior: () => ({ y: 0 }),
    routes,
    history: true,
})

router.beforeEach((to, from, next) => {
    if (['all', 'active', 'completed'].some(record => record === to.params.filter)) {
        next()
    } else {
        next('all')
    }
})

export default router
