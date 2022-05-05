<template>
    <Head>

        <title>Users</title>
        <meta
            type="description"
            content="Information about Users"
            head-key="description"
        >
    </Head>

    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl ">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">New User</Link>
        </div>
        <input v-model="search" type="text" placeholder="search ..." class="border px-2 rounded">
    </div>

    <!-- component -->
    <!-- This is an example component -->
    <div class="max-w-2xl mx-auto">

        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="user in users.data" key="user.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">

                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{user.name}}</td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <Link :href="`/users/${user.id}/edit`" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--    paginator-->
    <Pagination :links="users.links" class="mt-8" />


</template>

<script>
import Layout from "../../Shared/Layout";
import { Link } from '@inertiajs/inertia-vue3';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from "../../Shared/Pagination";
import { ref ,watch } from "vue";
import {debounce} from "lodash";

export default {
    layout:Layout,
    components: {Pagination,  Link , Head },

    props : {
        users : Object,
        filters : Object,
        can:Object,
    },

    data(){
        return{
            search : this.filters.search
        }
    },

    watch:{
        search: debounce(function(value){
            this.$inertia.get('/users',{ search : value},
                {
                    preserveState:true,
                    replace :true,
                })
            },300)
        }

}

</script>
