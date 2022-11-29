<template>
    <div class="add-blogs">
        <h3>Add New Blog</h3>

        <form @submit.prevent="blog_data">
            <input type="text" placeholder="Blog Title" v-model="blogForm.title">
            <span class="danger" v-if="blogFormError.title">{{ blogFormError.title }}</span>

            <input type="text" placeholder="Blog Caption" v-model="blogForm.caption">
            <span class="danger" v-if="blogFormError.caption">{{ blogFormError.caption }}</span>

            <input type="text" placeholder="Blog Meta" v-model="blogForm.meta">
            <span class="danger" v-if="blogFormError.meta">{{ blogFormError.meta }}</span>

            <div class="form-image">
                <input type="file" placeholder="Select Image" @change="blogImage">
                <div id="preview">
                    <img v-if="imagePreview" :src="imagePreview" />
                </div>
            </div>
            <span class="danger" v-if="blogFormError.image">{{ blogFormError.image }}</span>

            <textarea placeholder="Blog Details" v-model="blogForm.details"></textarea>
            <span class="danger" v-if="blogFormError.details">{{ blogFormError.details }}</span>

            <button type="submit">Add Blog</button>
        </form>
    </div>
</template>
  
<script setup>
    import { reactive, ref  } from 'vue'
    import { useRouter  } from 'vue-router'
    import { useBlogsStore } from '@/stores/blogs'
	
	const blogStore = useBlogsStore()
	const router = useRouter()

    const blogForm = reactive({
		title: '',
		meta: '',
		caption: '',
		image: '',
        details: '',
	})
    const imagePreview = ref('')

    const blogFormError = reactive({
		title: '',
		meta: '',
		caption: '',
		image: '',
        details: '',
	})

    const blogImage = (e) => {
        const image = e.target.files[0];
        imagePreview.value = URL.createObjectURL(image);
        blogForm.image = image;
    }

    const blog_data = () => {
		if(blogForm.title == "") {
			blogFormError.title = 'Please Enter Blog Title';
            setTimeout(() => blogFormError.title = '', 3000)
		}
		if(blogForm.caption == "") {
			blogFormError.caption = 'Please Enter Blog Caption';
            setTimeout(() => blogFormError.caption = '', 3000)
		}
		if(blogForm.meta == "") {
			blogFormError.meta = 'Please Enter Blog Meta';
            setTimeout(() => blogFormError.meta = '', 3000)
		}
		if(blogForm.image == "") {
			blogFormError.image = 'Please Select Image';
            setTimeout(() => blogFormError.image = '', 3000)
		}
        if(blogForm.details == "") {
			blogFormError.details = 'Please Enter Blog Details';
            setTimeout(() => blogFormError.details = '', 3000)
		}

		if (blogForm.title != '' && blogForm.caption != '' && blogForm.meta != '' && blogForm.image != '' && blogForm.details != '') {
			let data = new FormData()
			data.append('title', blogForm.title)
			data.append('caption', blogForm.caption)
			data.append('meta', blogForm.meta)
			data.append('image', blogForm.image)
			data.append('details', blogForm.details)

			blogStore.create_blog(data).then(()=> {
                router.push({name: 'blogs'})
            })
		}
	}
</script>