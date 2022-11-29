<template>
    <main>
        <!-- heading -->
        <header>
            <h1>Pinia Blog System</h1>
        </header>
        <nav>
            <ul class="nav">
                <li class="current">
                    <router-link class="link active" :to="{name : 'welcome'}">Home</router-link>
                </li>
                <li>
                    <router-link class="link" :to="{name : 'blogs'}">Blogs</router-link>
                </li>
                <li>
                    <router-link class="link" :to="{name : 'add-blog'}">Add Blog</router-link>
                </li>
            </ul>
        </nav>
    </main>
</template>