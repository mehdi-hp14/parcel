const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Roles/RolesList');
const Create = () => import('../components/Roles/RolesCreate');
const Edit = () => import('../components/Roles/RolesEdit');

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
                    path: 'admin/roles/roles/index',
                    component: Index,
                    name: 'roles.index',
                    meta: {
                        title: 'لیست دسترسی ها',
                    },
                },
                {
                    path: 'admin/roles/roles/:id/edit',
                    component: Edit,
                    name: 'roles.edit',
                    meta: {
                        title: 'به روز رسانی نقش',
                    },
                },
                {
                    path: 'admin/roles/roles/create',
                    component: Create,
                    name: 'roles.create',
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
