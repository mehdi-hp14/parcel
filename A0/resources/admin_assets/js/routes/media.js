const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Media/MediaList');
const Create = () => import('../components/Media/MediaCreate');

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
                    path: 'admin/contents/media/index',
                    component: Index,
                    name: 'media.index',
                    meta: {
                        title: 'لیست مدیا',
                    },
                },
                {
                    path: 'admin/contents/media/create',
                    component: Create,
                    name: 'media.create',
                    meta: {
                        title: 'مدیا ی جدید',
                    },
                },
            ],
        },
    ];

export default routes;
