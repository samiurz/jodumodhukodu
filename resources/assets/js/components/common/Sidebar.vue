<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <router-link :to="'/dashboard'" class="nav-link">
                        <i class="icon-speedometer"></i> Dashboard
                        <span class="badge badge-info">NEW</span>
                    </router-link>
                </li>
                <!-- <li class="nav-title">
                    UI Elements
                </li> -->
                <!-- <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/components'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-puzzle"></i> Components</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/components/buttons'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Buttons</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/social-buttons'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Social Buttons</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/cards'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Cards</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/forms'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Forms</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/modals'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Modals</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/switches'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Switches</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/components/tables'" class="nav-link" exact>
                                <i class="icon-puzzle"></i> Tables</router-link>
                        </li>
                    </ul>
                </router-link> -->
                <!-- <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/icons'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Icons</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/icons/font-awesome'" class="nav-link" exact>
                                <i class="icon-star"></i> Font Awesome</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/icons/simple-line-icons'" class="nav-link" exact>
                                <i class="icon-star"></i> Simple Line Icons</router-link>
                        </li>
                    </ul>
                </router-link> -->

                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/account'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Account</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/account/list'" class="nav-link" exact>
                                <i class="icon-star"></i> Account</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/company/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Company
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/accountBlockAssociation/list'" class="nav-link" exact>
                                <i class="icon-star"></i>Account Block Association</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/activity/list'" class="nav-link" exact>
                                <i class="icon-star"></i>Activity</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/block/list'" class="nav-link" exact>
                                <i class="icon-star"></i>Block</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/blockStat/list'" class="nav-link" exact>
                                <i class="icon-star"></i>Block Status</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/module/list'" class="nav-link" exact>
                                <i class="icon-star"></i>Module</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/customerBlockModuleActivity/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Customer Activity
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <li class="divider"></li>
                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/settings'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Settings</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/label/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Label
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/quality/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Quality
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/assetLocation/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Asset Location
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/documentationType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Document Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/document/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Document
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/roletype/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Role Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/jobType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Job Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/jobPriority/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Job Priority
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <li class="divider"></li>
                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/products'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Product Settings</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/manufacturer/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Manufacturer
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/modelType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Model Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/assetModel/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Asset Model
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/faultType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Fault Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/repairType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Repair Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/spareType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Spare Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/jobType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Job Type
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <li class="divider"></li>
                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/Spares'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Spare</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/spareType/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Spare Type
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/spare/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Spare Lists
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <li class="divider"></li>
                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/asset'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Asset</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/asset/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Asset List
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <li class="divider"></li>
                <router-link tag="li" class="nav-item nav-dropdown" :to="{ path: '/job'}" disabled>
                    <div class="nav-link nav-dropdown-toggle" @click="handleClick">
                        <i class="icon-star"></i> Job</div>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/job/list'" class="nav-link" exact>
                                <i class="icon-calculator"></i> Job List
                            </router-link>
                        </li>
                    </ul>
                </router-link>
                <!-- <li class="nav-item">
                    <router-link :to="'/charts'" class="nav-link" exact>
                        <i class="icon-pie-chart"></i> Charts</router-link>
                </li> -->
                <li class="divider"></li>
                <!-- <li class="nav-title">
                    Extras
                </li> -->
                <!-- <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#" @click="handleClick">
                        <i class="icon-star"></i> Pages</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="'/pages/login'" class="nav-link" exact>
                                <i class="icon-star"></i> Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/pages/register'" class="nav-link" exact>
                                <i class="icon-star"></i> Register</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/pages/404'" class="nav-link" exact>
                                <i class="icon-star"></i> Error 404</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="'/pages/500'" class="nav-link" exact>
                                <i class="icon-star"></i> Error 500</router-link>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>
</template>
<script>
    export default {
        name: "sidebar",
        methods: {
            handleClick(e) {
                e.preventDefault();
                e.target.parentElement.classList.toggle("open");
            }
        }
    };
</script>

<style lang="css">
    .nav-link {
        cursor: pointer;
    }
</style>