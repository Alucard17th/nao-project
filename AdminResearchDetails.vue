<template>
    <div class="research-proposal-list">
        <div class="card add-bloc py-4 px-4 mb-4">
            <a class="cursor-p pl-1 pr-3" @click="$router.go(-1)">
                <i class="fal fa-long-arrow-left pr-1"></i> retour
            </a>

            <h3 class="mb-4 mt-2 text-blue">
                Détails de la recherche
                <template v-if="isResearchLoaded && research && !research.deleted_at">
                    <span class="badge cursor-p" @click="togglePublic" :class="research.public ? 'badge-success text-white' : 'badge-secondary' ">
                        <i v-if="research.public" class="far fa-fw fa-eye"></i>
                        <i v-else class="far fa-fw fa-eye-slash"></i>
                        {{ research.public ? 'Rendre invisible sur l\'accueil': 'Rendre visible sur l\'accueil' }}
                    </span>
                    <span>
                        <span @click="toggleStill" class="badge cursor-p" :class="research.still ? 'badge-success text-white' : 'badge-secondary'">
                            {{ research.still ? 'Ne plus prolonger': 'Prolonger' }}
                        </span>
                    </span>
                </template>
            </h3>
            <div class="container-fluid position-relative pt-2" v-if="isResearchLoaded && research">

                <div class="row text-blue research-proposal-list-filter">
                    <div class="col-12 col-md-8 order-3 order-md-2">
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Langue d'origine</p>
                            </div>
                            <div class="col">
                                <template v-if="research.original_language">
                                    {{research.original_language}}
                                </template>
                                <p v-else>inconnue</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Modèle</p>
                            </div>
                            <div class="col">
                                <p class="mb-1" v-if="research.modele">{{
                                        research.modele.year ? research.modele.modele.brand.name + ' ' + research.modele.modele.name + ' (' + research.modele.year + ')' :
                                            research.modele.modele.brand.name + ' ' + research.modele.modele.name + ' (' + research.modele.modele.year_start + '-' + research.modele.modele.year_end + ')'
                                    }}</p>
                                <p v-else> - </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Version</p>
                            </div>
                            <div class="col">
                                <p class="mb-1" v-if="research.modele">
                                    {{
                                        research.modele.version ? research.modele.version : 'Non renseigné'
                                    }}</p>
                                <p v-else> - </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Pièce</p>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Type(s) de pièce</p>
                            </div>
                            <div class="col">
                                <ul class="pl-3 mt-1">
                                    <li v-if="research.type">{{ getStatusText(research.type) }}</li>
                                    <template v-else>
                                        <li v-for="type in research.types">
                                            {{ getStatusText(type) }}
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Référence</p>
                            </div>
                            <div class="col">
                                <p class="mb-1" v-if="research.reference">{{ research.reference }}</p>
                                <p class="mb-1" v-else>Pas de référence renseignée</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Détails</p>
                            </div>
                            <div class="col">
                                <p class="mb-1" style="white-space: pre-line;" v-if="research.original_details">{{ research.original_details }}</p>
                                <p class="mb-1" v-else>Pas d'informations complémentaires</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Compatibilité de la pièce</p>
                            </div>
                            <div class="col">
                                <p class="mb-1" v-if="research.compatible_suggestion">{{ research.compatible_suggestion }}</p>
                                <p class="mb-1" v-else>Pas d'informations complémentaires</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Date de recherche</p>
                            </div>
                            <div class="col">
                                <p class="mb-1">{{ research.created_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Nom de l'utilisateur</p>
                            </div>
                            <div class="col">
                                <p class="mb-1">{{ research.user.firstname + ' ' + research.user.lastname }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">E-mail</p>
                            </div>
                            <div class="col">
                                <p class="mb-1">{{ research.user.email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1">Adresse</p>
                            </div>
                            <div class="col">
                                <p class="mb-1">{{
                                        research.user.address ? research.user.address : 'Non renseigné'
                                    }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="lead mb-1"></p>
                            </div>
                            <div class="col">
                                <p class="mb-1">
                                    {{
                                        research.user.zip ? research.user.zip + ' ' + research.user.city : 'Non renseigné'
                                    }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                            </div>
                            <div class="col">
                                <p class="mb-1">{{ research.user.region ? research.user.region.name : '' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                            </div>
                            <div class="col">
                                <p class="mb-1">{{ research.user.country ? research.user.country.name : '' }}</p>
                            </div>
                        </div>
                        <div class="row" v-if="research.img.length>0">
                            <div class="col-md-5">
                                <p class="lead mb-1">Photos</p>
                            </div>
                        </div>
                       
                        <div class="row" v-if="research.img.length>0">
                            <div class="col">

                                <div class="img-wrapper mb-3" v-if="research.img != null">

                                    <div v-if="research.img.length == 1" @click="zoom(0)" :key="0" class="h-100">
                                        <zoom-on-hover class="h-100 w-100" :img-normal="research.img[0]" :scale="1.2"></zoom-on-hover>
                                    </div>

                                    <b-carousel
                                        v-model="slide"
                                        :interval="0"
                                        controls
                                        indicators
                                        background="#ababab"
                                        class="h-100"
                                        img-width="1024"
                                        img-height="100%"
                                        v-else
                                    >

                                        <b-carousel-slide v-for="(i, imageIndex) in research.img" :key="imageIndex">
                                            <template v-slot:img>
                                                <div class="h-100" @click="zoom(imageIndex)" :key="imageIndex">
                                                    <zoom-on-hover class="h-100 w-100" :img-normal="i" :scale="1.2"></zoom-on-hover>
                                                </div>
                                            </template>
                                        </b-carousel-slide>

                                    </b-carousel>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 order-2 order-md-3">
                        <img v-if="research.modele && research.modele.modele.img" :src="'/images/Cars/'+research.modele.modele.img+'.png'"
                             class="w-75" @error="research.modele.modele.img = null">
                        <img v-else :src="'/images/Cars/emptycar.png'" class="w-75">
                    </div>
                </div>
                <div class="row mt-5" v-if="!research.deleted_at">
                    <div class="col-5" v-if="research.status ==null && research.part_id !== null">
                        <button class="btn btn-sm btn-full btn-center bg-gold " @click="changeResearchStatus([research]).then(res=>{$router.push({name:'admin-research-waiting'})})">Valider la recherche
                        </button>
                    </div>

                    <div class="col-5" v-else-if="research.part_id === null">
                        <button class="btn btn-sm btn-full btn-center bg-gold" v-b-modal.modal-lg="'modal-center'+research.id">
                            Créer/Assigner une pièce à la recherche
                        </button>
                    </div>

                    <div class="col ">
                        <div v-if="!Array.isArray(research.modifications)">
                            <router-link :to="{name:'researchChanges', params:{id:research.id}}" class="btn btn-sm btn-full btn-center bg-dark-grey">
                                Voir mes modifications
                            </router-link>
                        </div>
                        <router-link v-else :to="{name:'adminEditResearch',params:{id:research.id}}" class="btn btn-sm btn-full btn-center btn-primary" :class="{'disabled':isDisabled}">
                            Modifier la recherche {{ timeLeft ? ' - ' + timeLeft + ' sec' : '' }}
                        </router-link>
                    </div>

                    <div class="col">
                        <button v-b-modal.modal="'modal-remove-' + research.id" class="btn btn-sm btn-full btn-danger btn-center">
                            {{ research.status == null || research.part_id == null ? 'Rejeter cette recherche' : 'Supprimer cette recherche' }}
                        </button>
                    </div>




                </div>
                <b-modal :id="'modal-center'+research.id" centered hide-footer hide-header
                         v-if="research.part_id === null" size="lg">
                    <div class="py-4 row text-blue">

                        <div class="col-12">
                            <h2 class="text-center">La pièce suggérée est</h2>
                        </div>
                        <div class="offset-md-2 col-md-8 bg-grey p-3 py-4 mt-2">
                            <p v-if="research.unknown_part!=null" class="h3 mb-0 text-center">{{ research.unknown_part.message }} -
                                {{ translation('name', research.unknown_part, 'category') }}</p>
                        </div>
                        <div class="col-12 p-3 mt-2">
                            <p class="lead mb-0 text-center" v-if="research.modele">
                                {{ research.modele.modele.brand.name }} {{ research.modele.modele.name }}
                                ({{ research.modele.modele.year_start }}-{{ research.modele.modele.year_end }})</p>
                            <p v-else> - </p>
                        </div>
                        <p class="text-blue text-info text-center w-100"><i class="far fa-info-circle pr-1"></i> Vous
                            devez compléter la recherche pour qu'elle soit prise en compte</p>
                        <div class="offset-md-1 col-md-5">
                            <a class="btn bg-gold btn-lg w-100" @click="selectCreate(research)">Créer la pièce</a>
                        </div>
                        <div class="col-md-5">
                            <a class="btn bg-gold btn-lg w-100" @click="selectAssign(research)">Assigner la
                                pièce</a><br>
                        </div>

                        <div class="col-md-10 offset-md-1">
                            <form v-if="modalState===1" class="border d-flex flex-wrap mt-4 p-4">
                                <div class="form-group d-flex justify-content-start form-sm col-12">
                                    <input id="link" class="form-control w-auto mr-2" type="checkbox"
                                           @change="setCarId(research)">
                                    <label for="link">La pièce n'est disponible que pour ce véhicule</label>
                                </div>

                                <div class="form-group form-sm col-md-6">
                                    <label for="name">Nom de la pièce</label>
                                    <input id="name" class="form-control" type="text" v-model="nameFR"
                                           placeholder="Nom">
                                </div>
                                <div class="form-group form-sm col-md-6">
                                    <label for="category">Catégorie de la pièce : </label>
                                    <select id="category" class="form-control" v-model="categorySelected">
                                        <option v-for="category in allCategories"
                                                :value="category.id">{{ translation('name', category) }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-sm bg-gold mt-2"
                                       :class="nameFR!=''&&categorySelected!=''?'':'disabled'"
                                       @click="createAssign(research); $bvModal.hide('modal-center'+research.id)">Créer
                                        et associer</a>
                                </div>

                            </form>
                            <div class="border mt-4 p-4" v-if="modalState===2">
                                <div class="form-group col-12">
                                    <label for="researchPart">Nom de la pièce</label>
                                    <autocomplete
                                        id="researchPart"
                                        ref="autocomplete1"
                                        name="researchPart"
                                        key="1"
                                        :search="searchPart"
                                        :get-result-value="getResultValuePart"
                                        :debounce-time="1"
                                        default-value=""
                                        @submit="selectPart($event)"
                                        placeholder="Pièce détachée"
                                        class="w-100 auto-cat-home">
                                    </autocomplete>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-sm bg-gold mt-2" :class="partSelected!==0?'':'disabled'"
                                       @click="assign(research)">Assigner</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </b-modal>
                <b-modal :id="'modal-remove-' + research.id" centered hide-footer hide-header content-class='border-0 rounded px-3'>

                    <div class="alert alert-info mb-0 d-flex">
                        <i class="far fa-info-circle pt-1 mr-2"></i>
                        Un email sera envoyé à la personne qui a fait la recherche avec la raison ci-dessous.
                    </div>
                    <div class="form form-xl pt-2 py-2">
                        <label for="message">{{ research.status == null || research.part_id == null ? 'Raison du rejet ' : 'Raison de la suppression' }}</label>
                        <textarea class="w-100 pt-3" rows="4" type="text" id="message" v-model="message"></textarea>
                    </div>

                    <button @click="reject" class="btn btn-danger btn-sm float-right">

                        {{ research.status == null || research.part_id == null ? 'Confirmer le rejet' : 'Confirmer la suppression' }}

                    </button>
                </b-modal>

            </div>
            <div v-else><span class="loader"></span></div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import mxResearches from "../../../mixins/Researches";
import {status} from "../../../mixins/status";

export default {
    name: 'adminResearchDetails',
    data() {
        return {
            timeLeft: 0,
            message: '',
            size: 0,
            research: null,
            modalState: 0,
            nameFR: '',
            nameDE: '',
            nameEN: '',
            carSelected: null,
            categorySelected: '',
            partSelected: 0,
            slide: null
        }
    },
    mixins: [mxResearches, status],

    methods: {
        ...mapActions('messages', ['newMessage']),
        ...mapActions('parts', ['assignPart', 'newPart']),
        ...mapActions('researches', ['fetchAllResearches', 'fetchResearch', 'fetchResearchAdmin']),
        ...mapActions('admin', ['changeResearchStatus']),
        resetForm() {
            this.modalState = 0;
            this.nameFR = '';
            this.nameEN = '';
            this.nameDE = '';
            this.carSelected = null;
            this.categorySelected = '';
            this.partSelected = 0;
        },
        reject() {
            if (!this.$auth.user()) {
                return this.$router.push({name: 'login'})
            }
            axios.post('admin/' + this.$auth.user().id + '/researches/' + this.research.id + '/reject',
                {message: this.message}).then(res => {
                this.$store.commit('admin/REMOVE_RESEARCH', this.research)
                this.$router.go(-1)
            })
        },
        zoom(index) {
            this.showBox([this.research.img])
            this.setIndex(index)
        },
        selectCreate() {
            this.modalState = 1;
            this.partSelected = 0
        },
        async createAssign(research) {
            const part = await this.newPart({
                translation: {'name': {'fr_FR': this.nameFR}},
                modele_id: this.carSelected,
                category_id: this.categorySelected
            })
            await this.assignPart([research, part.id]);
            this.research = await this.fetchResearchAdmin(this.$route.params.id).then(res => res.data);
            this.timerCountdown()
            this.resetForm();
            this.$forceUpdate()
        }, selectAssign(research) {
            this.modalState = 2;
            this.carSelected = research.modele.modele_id
        },
        async assign(research) {
            await this.assignPart([research, this.partSelected])
            await this.fetchResearchAdmin(this.$route.params.id).then(res => this.research = res.data);
            this.resetForm();
            this.$bvModal.hide('modal-center' + research.id)
        },
        setCarId(research) {
            if (this.carSelected == null) this.carSelected = research.modele.modele_id;
            else this.carSelected = null;
        },
        timerCountdown() {
            if (this.research.status !== 'in_progress') {
                return
            }
            const timer = setInterval(() => {
                let now = new Date()
                let interval = this.timeBeforeEditAllowed - now
                if (interval < 0) {
                    return clearInterval(timer)
                }
                this.timeLeft = Math.floor(interval / 1000)

            }, 1000)
        },
        async togglePublic() {
            const publicValue = await axios.get('/toggle-public-status/research/' + this.research.id).then(res => res.data)
            this.research.public = publicValue
        },
        async toggleStill() {
            this.research.still = await axios.get('/admin/research/' + this.research.id + '/toggle-still').then(res => res.data.still)
        },
        ...mapActions('coolLightBox', ['showBox', 'setIndex'])
    },
    created() {
        this.fetchAllResearches();
        this.fetchResearchAdmin(this.$route.params.id).then(res => {
            this.research = res.data
            this.timerCountdown()
        });
        this.$store.dispatch('categories/fetchAllCategories');
    },
    beforeRouteUpdate (to, from, next) {
        this.fetchResearchAdmin(this.$route.params.id).then(res => {
            this.research = res.data
            this.timerCountdown()
        });
        next()
    },
    computed: {
        ...mapGetters('researches', ['isResearchLoaded']),
        ...mapGetters('categories', ['allCategories']),
        isDisabled() {
            return this.timeLeft !== 0||!Array.isArray(this.research.modifications)
        },
        timeBeforeEditAllowed() {
            let date = new Date(this.research.updated_at);
            date.setSeconds(date.getSeconds() + 30);
            return date
        }
    }
}

</script>
