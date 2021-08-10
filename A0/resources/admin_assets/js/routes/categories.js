const Layout = () => import('../components/Layouts/AppLayout/AppLayout');
const Index = () => import('../components/Categories/CategoriesList');
const Create = () => import('../components/Categories/CategoriesCreate');
const Edit = () => import('../components/Categories/CategoriesEdit');

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
                    path: 'admin/contents/categories/index',
                    component: Index,
                    name: 'categories.index',
                    meta: {
                        title: 'لیست دسته بندی ها',
                    },
                },
                {
                    path: 'admin/contents/categories/:id/edit',
                    component: Edit,
                    name: 'categories.edit',
                    meta: {
                        title: 'به روز رسانی دسته بندی',
                    },
                },
                {
                    path: 'admin/contents/categories/create',
                    component: Create,
                    name: 'categories.create',
                    meta: {
                        title: 'دسته بندی جدید',
                    },
                },
            ],
        },
    ];

export default routes;
