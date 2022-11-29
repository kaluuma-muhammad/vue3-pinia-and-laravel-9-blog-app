<template>
    <Nav />
    <div class="container">
        <router-view/>
    </div>
</template>

<script setup>
    import '@/assets/app.css'
    import Nav from './includes/nav.vue'
</script>