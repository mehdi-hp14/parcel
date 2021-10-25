const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Posts/PostsList');
const Create = () => import('../components/Posts/PostsCreate');
const Edit = () => import('../components/Posts/PostsEdit');

// import Layout from "../components/Layouts/AppLayout/AppLayout";
// import Index from "../components/Posts/PostsList";

const routes =
    [
        {
            path: '/',
            component: Layout,
            meta: {
                bodyClass: 'layout',
            },
            children: [
                {
                    path: 'admin/contents/posts/index',
                    component: Index,
                    name: 'posts.index',
                    meta: {
                        title: 'لیست پست ها',
                    },
                },
                {
                    path: 'admin/contents/posts/:id/edit',
                    component: Edit,
                    name: 'posts.edit',
                    meta: {
                        title: 'به روز رسانی پست',
                    },
                },
                {
                    path: 'admin/contents/posts/create',
                    component: Create,
                    name: 'posts.create',
                    meta: {
                        title: 'پست جدید',
                    },
                },
            ],
        },
    ];

export default routes;
