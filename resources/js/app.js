import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';


createInertiaApp({
    title: title => `My App - ${title}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if(page.layout === undefined){
            page.layout = Layout;
        }

        return page;
    },

    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },

    //title: title => `My App - ${title}`

});


InertiaProgress.init({
    color : 'green',
    showSpinner : true,
});
