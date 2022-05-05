<template>
    <Head>
        <title>Home</title>
    </Head>
    <h1 class="text-3xl">Home</h1>
</template>

<script>
import Nav from "../Shared/Nav";
import Layout from "../Shared/Layout";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    layout:Layout,
    components: { Nav , Head },
};
</script>
