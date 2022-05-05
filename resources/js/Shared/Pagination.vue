<template>
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            class="px-1"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            :class="{'text-gray-500' : !link.url , 'font-bold' : link.active}"
            />
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    props: {
        links: Array
    },
    components:{Link}
}
</script>

<style scoped>

</style>
