<template>
    <Head>
        <title>Tasks</title>
        <meta
            type="description"
            content="Information about Users"
            head-key="description"
        >
    </Head>

    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl ">Tasks</h1>
        </div>
    </div>
    <div v-if="$page.props.auth != null">
        <form @submit.prevent="submit" class="flex max-w-3xl mx-auto items-center justify-between space-x-4">
            <div class="mb-6 w-full">
                <input v-model="form.name"
                       class="border border-gray-400 p-2 w-full"
                       type="text"
                       name="name"
                       id="name"
                       placeholder="Add New Task"
                       required
                >
                <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
            </div>
            <div class="mb-6">
                <button type="submit"
                        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                        :disabled="form.processing"
                >Add
                </button>
            </div>
        </form>
    </div>
    <div v-else class="max-w-3xl mx-auto bg-orange-500 rounded-3 my-4">
       <p class="p-3">Log in to add tasks</p>

    </div>
    <!-- component -->
    <!-- This is an example component -->
    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="task in tasks" key="task.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">

                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{task.name}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{task.owner}}</td>
                                <td v-if="task.can.deleteTask" class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <Link method="delete" :href="`/tasks/${task.id}`" class="text-blue-600 dark:text-blue-500 hover:underline">Delete</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>

<script>
import Layout from "../../Shared/Layout";
import { Link } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import { ref ,watch } from "vue";
import {debounce} from "lodash";

export default {
    layout:Layout,
    components: { Link , Head },

    props : {
        tasks : Object,
        // filters : Object,
        // can:Object,
    },
    data(){
        return {
            form : this.$inertia.form({
                name:'',
            }),
        }
    },

    methods :{
        submit(){
            this.form.post('/tasks',{
                onSuccess: ()=> form.reset('name')
            })
            this.form.name ='';

        }
    },
}

</script>
