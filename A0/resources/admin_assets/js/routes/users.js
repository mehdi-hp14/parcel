const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Users/UsersList');

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
                    path: 'admin/contents/users/index',
                    component: Index,
                    name: 'users.index',
                    meta: {
                        title: 'لیست کاربران',
                    },
                },
            ],
        },
    ];

export default routes;
