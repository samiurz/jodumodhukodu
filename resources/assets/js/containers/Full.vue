<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar/>
            <main class="main">
                <breadcrumb :list="list" />
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </main>
            <AppAside/>
        </div>
        <AppFooter/>
    </div>
</template>

<script>
    // import AppHeader from '../components/Header'
    // import Sidebar from '../components/Sidebar'
    // import AppAside from '../components/Aside'
    // import AppFooter from '../components/Footer'
    // import Breadcrumb from '../components/Breadcrumb'

    import AppHeader from '../components/common/Header'
    import Sidebar from '../components/common/Sidebar'
    import AppAside from '../components/common/Aside'
    import AppFooter from '../components/common/Footer'
    import Breadcrumb from '../components/common/Breadcrumb'

    export default {
        name: 'full',
        components: {
            AppHeader,
            Sidebar,
            AppAside,
            AppFooter,
            Breadcrumb
        },
        computed: {
            name() {
                return this.$route.name
            },

            list() {
                return this.$route.matched
            }
        }
    }
</script>