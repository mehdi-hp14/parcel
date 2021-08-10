const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Permissions/PermissionsList');
const Create = () => import('../components/Permissions/PermissionsCreate');

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
                    path: 'admin/permissions/permissions/index',
                    component: Index,
                    name: 'permissions.index',
                    meta: {
                        title: 'لیست دسترسی ها',
                    },
                },
                {
                    path: 'admin/permissions/permissions/create',
                    component: Create,
                    name: 'permissions.create',
                    meta: {
                        title: 'دسترسی جدید',
                    },
                },
                // {
                //     path: 'admin/contents/categories/:id/edit',
                //     component: Edit,
                //     name: 'categories.edit',
                //     meta: {
                //         title: 'به روز رسانی دسته بندی',
                //     },
                // },
                // {
                //     path: 'admin/contents/categories/create',
                //     component: Create,
                //     name: 'categories.create',
                //     meta: {
                //         title: 'دسته بندی جدید',
                //     },
                // },
            ],
        },
    ];

export default routes;
