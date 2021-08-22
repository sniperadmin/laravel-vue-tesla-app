import Vue from 'vue';
import Router from 'vue-router'
import Todo from './components/Todo.vue'
import Modal from './components/partials/Modal.vue'
import Home from './views/Home.vue'

Vue.use(Router)

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/todos/:filter',
        name: 'todos',
        component: Todo,
        props: true,
        meta: {
            auth: {
                redirect: '/login'
            }
        },
        beforeRouteEnter(to, from, next) {
            console.info(
                ["all", "active", "completed"].some(
                    record => record === to.params.filter
                )
            );
            if (['all', 'active', 'completed'].some(record => record === to.params.filter)) {
                next()
            } else {
                next('all')
            }
        },
    },
    {
        path: '/login',
        name: 'login',
        component: Modal,
        props: false,
        meta: {
            showModal: true
        }
    },
]

const router = new Router({
    scrollBehavior: () => ({ y: 0 }),
    routes,
    mode: 'history',
})

export default router
