import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { PiniaExtractPlugin } from "pinia-extract";
import App from './App.vue'
import router from './router'
import '@/axios'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)
pinia.use(PiniaExtractPlugin);

const app = createApp(App)

app.use(pinia)
app.use(router)

app.mount('#app')
