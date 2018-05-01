import Vue from 'vue';
import Router from 'vue-router';

// Containers
import Full from '../containers/Full';

// Views
import Dashboard from '../views/Dashboard';
import Charts from '../views/Charts';
import Widgets from '../views/Widgets';

// Views - Components
import Buttons from '../views/components/Buttons';
import SocialButtons from '../views/components/SocialButtons';
import Cards from '../views/components/Cards';
import Forms from '../views/components/Forms';
import Modals from '../views/components/Modals';
import Switches from '../views/components/Switches';
import Tables from '../views/components/Tables';

// Views - Icons
import FontAwesome from '../views/icons/FontAwesome';
import SimpleLineIcons from '../views/icons/SimpleLineIcons';

// Views - Pages
import Page404 from '../views/pages/Page404';
import Page500 from '../views/pages/Page500';
import Login from '../views/pages/Login';
import Register from '../views/pages/Register';

// Views - Company
import CompanyList from '../views/company/list';
import CompanyForm from '../views/company/form';

// Views - Block
import BlockList from '../views/block/list';
import BlockForm from '../views/block/form';

// Views - Block
import LabelList from '../views/label/list';
import LabelForm from '../views/label/form';

// Views - Block
import AccountBlockAssociationList from '../views/accountBlockAssociation/list';
import AccountBlockAssociationForm from '../views/accountBlockAssociation/form';

// Views - Activity
import ActivityList from '../views/activity/list';
import ActivityForm from '../views/activity/form';

// Views - Account
import AccountList from '../views/account/list';
import AccountForm from '../views/account/form';

// Views - Document Type
import DocumentationTypeList from '../views/documentationType/list';
import DocumentationTypeForm from '../views/documentationType/form';

// Views - Role Type
import RoleTypeList from '../views/roletype/list';
import RoleTypeForm from '../views/roletype/form';

// Views - Role Type
import CustomerBlockModuleActivityList from '../views/customerBlockModuleActivity/list';
import CustomerBlockModuleActivityForm from '../views/customerBlockModuleActivity/form';

// Views - Job Type
import JobTypeList from '../views/jobType/list';
import JobTypeForm from '../views/jobType/form';

// Views - Model Type
import ModelTypeList from '../views/modelType/list';
import ModelTypeForm from '../views/modelType/form';
Vue.use(Router);

export default new Router({
    mode: 'hash', // hash or hash = Demo is living in GitHub.io, so required!
    linkActiveClass: 'open active',
    scrollBehavior: () => ({ y: 0 }),
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
            name: 'Home',
            component: Full,
            children: [
                {
                    path: 'dashboard',
                    name: 'Dashboard',
                    component: Dashboard
                },
                {
                    path: 'charts',
                    name: 'Charts',
                    component: Charts
                },
                {
                    path: 'widgets',
                    name: 'Widgets',
                    component: Widgets
                },
                {
                    path: 'components',
                    redirect: '/components/buttons',
                    name: 'Components',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'buttons',
                            name: 'Buttons',
                            component: Buttons
                        },
                        {
                            path: 'social-buttons',
                            name: 'Social Buttons',
                            component: SocialButtons
                        },
                        {
                            path: 'cards',
                            name: 'Cards',
                            component: Cards
                        },
                        {
                            path: 'forms',
                            name: 'Forms',
                            component: Forms
                        },
                        {
                            path: 'modals',
                            name: 'Modals',
                            component: Modals
                        },
                        {
                            path: 'switches',
                            name: 'Switches',
                            component: Switches
                        },
                        {
                            path: 'tables',
                            name: 'Tables',
                            component: Tables
                        }
                    ]
                },
                {
                    path: 'icons',
                    redirect: '/icons/font-awesome',
                    name: 'Icons',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'font-awesome',
                            name: 'Font Awesome',
                            component: FontAwesome
                        },
                        {
                            path: 'simple-line-icons',
                            name: 'Simple Line Icons',
                            component: SimpleLineIcons
                        }
                    ]
                },
                {
                    path: '/company',
                    redirect: '/company/list',
                    name: 'Company',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Company Form',
                            component: CompanyForm
                        },
                        {
                            path: 'list',
                            name: 'Company List',
                            component: CompanyList
                        }
                    ]
                },
                {
                    path: '/block',
                    redirect: '/block/list',
                    name: 'Block',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Block Form',
                            component: BlockForm
                        },
                        {
                            path: 'list',
                            name: 'Block List',
                            component: BlockList
                        }
                    ]
                },
                {
                    path: '/label',
                    redirect: '/label/list',
                    name: 'Label',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Label Form',
                            component: LabelForm
                        },
                        {
                            path: 'list',
                            name: 'Label List',
                            component: LabelList
                        }
                    ]
                },
                {
                    path: '/accountBlockAssociation',
                    redirect: '/accountBlockAssociation/list',
                    name: 'Account Block Association',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Account Block Association Form',
                            component: AccountBlockAssociationForm
                        },
                        {
                            path: 'list',
                            name: 'Account Block Association List',
                            component: AccountBlockAssociationList
                        }
                    ]
                },
                {
                    path: '/activity',
                    redirect: '/activity/list',
                    name: 'Activity',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Activity Form',
                            component: ActivityForm
                        },
                        {
                            path: 'list',
                            name: 'Activity List',
                            component: ActivityList
                        }
                    ]
                },
                {
                    path: '/account',
                    redirect: '/account/list',
                    name: 'Account',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Account Form',
                            component: AccountForm
                        },
                        {
                            path: 'list',
                            name: 'Account List',
                            component: AccountList
                        }
                    ]
                },
                {
                    path: '/documentationType',
                    redirect: '/documentationType/list',
                    name: 'Documentation Type',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Documentation Type Form',
                            component: DocumentationTypeForm
                        },
                        {
                            path: 'list',
                            name: 'Documentation Type List',
                            component: DocumentationTypeList
                        }
                    ]
                },
                {
                    path: '/roletype',
                    redirect: '/roletype/list',
                    name: 'Role Type',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Role Type Form',
                            component: RoleTypeForm
                        },
                        {
                            path: 'list',
                            name: 'Role Type List',
                            component: RoleTypeList
                        }
                    ]
                },
                {
                    path: '/customerBlockModuleActivity',
                    redirect: '/customerBlockModuleActivity/list',
                    name: 'Customer Block Module Activity',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Customer Block Module Activity Form',
                            component: CustomerBlockModuleActivityForm
                        },
                        {
                            path: 'list',
                            name: 'Customer Block Module Activity List',
                            component: CustomerBlockModuleActivityList
                        }
                    ]
                },
                {
                    path: '/jobType',
                    redirect: '/jobType/list',
                    name: 'Job Type',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Job Type Form',
                            component: JobTypeForm
                        },
                        {
                            path: 'list',
                            name: 'Job Type List',
                            component: JobTypeList
                        }
                    ]
                },
                {
                    path: '/modelType',
                    redirect: '/modelType/list',
                    name: 'Model Type',
                    component: {
                        render(c) { return c('router-view'); }
                    },
                    children: [
                        {
                            path: 'form',
                            name: 'Model Type Form',
                            component: ModelTypeForm
                        },
                        {
                            path: 'list',
                            name: 'Model Type List',
                            component: ModelTypeList
                        }
                    ]
                }
            ]
        },
        {
            path: '/pages',
            redirect: '/pages/p404',
            name: 'Pages',
            component: {
                render(c) { return c('router-view'); }
            },
            children: [
                {
                    path: '404',
                    name: 'Page404',
                    component: Page404
                },
                {
                    path: '500',
                    name: 'Page500',
                    component: Page500
                },
                {
                    path: 'login',
                    name: 'Login',
                    component: Login
                },
                {
                    path: 'register',
                    name: 'Register',
                    component: Register
                }
            ]
        }
    ]
});
