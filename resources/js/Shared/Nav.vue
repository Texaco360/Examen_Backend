<template>
    <nav class="ml-6">
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/" :active="$page.component == 'Home'" >Home</NavLink>
            </li>

            <li v-if="$page.props.auth != null ? $page.props.auth.user.is_admin : false">
                <NavLink href="/users" :active="$page.component == 'Users'" >Users</NavLink>
            </li>
            <li>
                <NavLink href="/tasks" :active="$page.component == 'Tasks'">Tasks</NavLink>
            </li>
            <li v-if="$page.props.auth != null">
                <NavLink method="post" href="/logout">Log Out</NavLink>
            </li>
            <li v-else class="space-x-4">
                <NavLink href="/login">Log In</NavLink>
                <NavLink href="/register" >Registreer</NavLink>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import NavLink from "./NavLink";
export default {
    components : {NavLink, Link }
};
</script>

