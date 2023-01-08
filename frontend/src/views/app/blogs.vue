<template>
    <div class="blogs">
        <div class="blog" v-for="(blog, index) in all_blogs" :key="index">
            <img :src="blog.image_url" alt="blog-image">
            <div class="blog-details">
                <h1> {{ blog.title }} </h1>
                <p> {{ blog.details }} </p>

                <div class="blog-action">
                    <div class="about">
                        <span>Author: {{ blog.user.name }}</span> <br>
                        <span>Date: {{ blog.created_at }}</span>
                    </div>

                    <div class="action">
                        <button style="border: 1px solid #37c014; background-color: #37c014;" @click="edit_blog(blog.id)">edit</button>
                        <button @click="delete_blog_post(blog.id)">delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
	import { useBlogsStore } from '@/stores/blogs'
    import { useRouter  } from 'vue-router'
	
    const router = useRouter()
	const { get_blogs, get_blog, delete_blog, all_blogs }  = useBlogsStore()

    const edit_blog = (id) => {
        get_blog(id).then(()=>{
            router.push({ name: 'edit-blog', params:{id:id}});
        })
    }

    const delete_blog_post = (id) => {
        delete_blog(id).then(() => {
            get_blogs()
        })
    }

	// fetch blogs
    get_blogs()
</script>