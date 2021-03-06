<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialogData" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">{{ $t('content.frontend.shop.catalog.about.title', {product: name}) }}</span>
                </v-card-title>
                <v-card-text>
                    <v-container class="text-xs-center">
                        <img :src="image" class="product-image" :alt="name">
                    </v-container>
                    <v-container class="text-xs-center subheading" v-if="!description">
                        {{ $t('content.frontend.shop.catalog.about.description.empty') }}
                    </v-container>
                    <v-container v-else>
                        <p class="text-xs-center subheading">{{ $t('content.frontend.shop.catalog.about.description.title') }}</p>
                        <div v-html="description"></div>
                    </v-container>
                    <v-container>
                        <v-layout row>
                            <v-flex xs6>{{ $t('content.frontend.shop.catalog.about.type') }}</v-flex>
                            <v-flex xs6 class="text-xs-right">
                                <span v-if="isItem">
                                    {{ $t('common.item.type.item') }}
                                </span>
                                <span v-else-if="isPermgroup">
                                    {{ $t('common.item.type.permgroup') }}
                                </span>
                                <span v-else-if="isCurrency">
                                    {{ $t('common.item.type.currency') }}
                                </span>
                                <span v-else-if="isRegionOwner">
                                    {{ $t('common.item.type.region_owner') }}
                                </span>
                                <span v-else-if="isRegionMember">
                                    {{ $t('common.item.type.region_member') }}
                                </span>
                                <span v-else-if="isCommand">
                                    {{ $t('common.item.type.command') }}
                                </span>
                            </v-flex>
                        </v-layout>

                        <v-layout v-if="enchantments.length !== 0" class="mt-3">
                            <v-flex xs6>{{ $t('content.frontend.shop.catalog.about.enchantments') }}</v-flex>
                            <v-flex xs6 class="text-xs-right">
                                <div v-for="enchantment in enchantments" class="purple--text">
                                    <span class="cp">
                                        {{ enchantment.name }}
                                        {{ enchantment.level }}
                                        <v-icon color="purple">flash_on</v-icon>
                                    </span>
                                </div>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click.native="dialogData = false">{{ $t('common.cancel') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        props: {
            dialog: {
                required: true,
                type: Boolean
            },
            name: {
                required: true,
                type: String
            },
            description: {
                required: true,
            },
            image: {
                required: true,
                type: String
            },
            isItem: {
                required: true,
                type: Boolean
            },
            isPermgroup: {
                required: true,
                type: Boolean
            },
            isCurrency: {
                required: true,
                type: Boolean
            },
            isRegionOwner: {
                required: true,
                type: Boolean
            },
            isRegionMember: {
                required: true,
                type: Boolean
            },
            isCommand: {
                required: true,
                type: Boolean
            },
            enchantments: {
                required: true,
                type: Array
            }
        },
        data() {
            return {
                dialogData: this.dialog
            }
        },
        watch: {
            dialog(val) {
                this.dialogData = val;
            },
            dialogData(val) {
                if (val === false) {
                    this.$emit('close');
                }
            }
        }
    }
</script>

<style lang="sass" scoped>
    .product-image
        max-width: 150px
</style>
