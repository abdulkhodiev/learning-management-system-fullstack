import "./bootstrap"
import "../css/app.css"

import { createApp, h, DefineComponent } from "vue"
import { createInertiaApp, Head, Link } from "@inertiajs/vue3"
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist"

import Layout from "@/Layouts/Layout.vue"

createInertiaApp({
  title: title => `LMS - ${title}`,
  resolve: name => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true })
    const page = pages[`./Pages/${name}.vue`] as DefineComponent
    page.default.layout = page.default.layout || Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component("Head", Head)
      .component("Link", Link)
      .mount(el)
  },
  progress: {
    color: "#4B5563",
  },
})
