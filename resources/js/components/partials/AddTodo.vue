<template>
    <v-card>
        <v-list class="pa-0">
            <v-list-item>
                <v-list-item-action>
                    <v-checkbox
                        v-if="todos.length > 0"
                        v-model="checked"
                        @change="toggleAll(checked)"
                        :false-value="0"
                        :true-value="1"
                        color="primary">
                    </v-checkbox>
                    <v-icon color="success" v-else>mdi-check</v-icon>
                </v-list-item-action>
                <v-text-field
                    v-model="newTodo"
                    :label="'New todo input'"
                    @keydown.enter="addTodo"
                    autofocus
                    autocomplete="off"
                    clearable
                    color="primary"
                    flat
                    hide-details
                    maxlength="1023"
                    placeholder="What needs to be done?"
                    solo
                ></v-text-field>
            </v-list-item>
        </v-list>
    </v-card>
</template>

<script>
export default {
    name: 'AddTodo',
    props: ['todos'],
    data () {
        return {
            newTodo: '',
            checked: null
        }
    },
    computed: {
        allChecked: {
            get() {
                return false
            },
            set() {
                if (this.todos && this.todos.length)
                    return this.todos.forEach(todo => todo.completed = !todo.completed)
            }
        },
    },
    methods: {
        addTodo() {
            this.$emit('add-todo', this.newTodo)
            this.newTodo = ''
        },
        toggleAll(value) {
            this.$emit('toggle-all', value)
        }
    }
}
</script>

<style>

</style>
