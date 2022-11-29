<template>
    <div class="edit-blog">
        <h3>Edit Blog</h3>

        <form @submit.prevent="blog_data">
            <input type="text" placeholder="Blog Title" v-model="single_blog.title">
            <span class="danger" v-if="blogFormError.title">{{ blogFormError.title }}</span>

            <input type="text" placeholder="Blog Caption" v-model="single_blog.caption">
            <span class="danger" v-if="blogFormError.caption">{{ blogFormError.caption }}</span>

            <input type="text" placeholder="Blog Meta" v-model="single_blog.meta">
            <span class="danger" v-if="blogFormError.meta">{{ blogFormError.meta }}</span>

            <div class="form-image">
                <input type="file" placeholder="Select Image" @change="updateBlogImage">
                <div id="preview">
                    <img v-if="imagePreview" :src="imagePreview" />
                    <img v-else :src="single_blog.image_url" />
                </div>
            </div>
            <span class="danger" v-if="blogFormError.image">{{ blogFormError.image }}</span>

            <textarea placeholder="Blog Details" v-model="single_blog.details"></textarea>
            <span class="danger" v-if="blogFormError.details">{{ blogFormError.details }}</span>

            <button type="submit">Update Blog</button>
        </form>
    </div>
</template>
  
<script setup>
    import { reactive, ref  } from 'vue'
    import { useRouter, useRoute  } from 'vue-router'
    import { useBlogsStore } from '@/stores/blogs'
	
	const router = useRouter()
	const route = useRoute()
    const id = route.params.id
	const { get_blog, update_blog, single_blog, update_blog_image }  = useBlogsStore()
    const imagePreview = ref('')

    const blogFormError = reactive({
		title: '',
		meta: '',
		caption: '',
		image: '',
        details: '',
	})

    const updateBlogImage = (e) => {
        const image = e.target.files[0];
        imagePreview.value = URL.createObjectURL(image);
        
        let data = new FormData()
        data.append('image', image)
        update_blog_image(data, id)
    }

    const blog_data = () => {
		if(single_blog.title == "") {
			blogFormError.title = 'Please Enter Blog Title';
            setTimeout(() => blogFormError.title = '', 3000)
		}
		if(single_blog.caption == "") {
			blogFormError.caption = 'Please Enter Blog Caption';
            setTimeout(() => blogFormError.caption = '', 3000)
		}
		if(single_blog.meta == "") {
			blogFormError.meta = 'Please Enter Blog Meta';
            setTimeout(() => blogFormError.meta = '', 3000)
		}
        if(single_blog.details == "") {
			blogFormError.details = 'Please Enter Blog Details';
            setTimeout(() => blogFormError.details = '', 3000)
		}

		if (single_blog.title != '' && single_blog.caption != '' && single_blog.meta != '' && single_blog.details != '') {
			let data = new FormData()
			data.append('title', single_blog.title)
			data.append('caption', single_blog.caption)
			data.append('meta', single_blog.meta)
			data.append('details', single_blog.details)

			update_blog(data, id).then(()=> {
                router.push({name: 'blogs'})
            })
		}
	}

    // get blog
    get_blog(id)
</script>