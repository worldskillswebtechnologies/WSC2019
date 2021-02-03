Vue.component('view-mode', {
    // language=HTML
    template: `
        <div id="view" ref="view">
            <!-- side -->
            <div class="side">
                <!-- menu -->
                <div class="menu">
                    <button class="btn btn-info" @click="editMode">Edit Mode</button>
                </div>
                <!-- arrows -->
                <div class="arrows">
                    <p class="mb-2" v-for="node in element.nodes" :key="node.id">
                        <button class="btn btn-dark arrow" :class="{disabled:!node.linkId}"
                            @click="change(node.id)">
                            <b>{{direction(node.id)}}</b>
                            <span>{{node.caption}}</span>
                        </button>
                    </p>
                </div>
                <!-- navigation -->
                <div class="navigation">
                    <div class="navigation-layout">
                        <edit-mode :elements="elements" :links="links"></edit-mode>
                    </div>
                </div>
            </div>
            <!-- viewer -->
            <div class="viewer">
                <!-- frame -->
                <div class="frame">
                    
                    <transition
                        :name="transitionName"
                        enter-active-class="slide-active" leave-active-class="slide-active"
                        mode="out-in" appear>
                        <!-- slide -->
                        <div class="slide" :key="element.key">
                            <div class="title">{{element.title}}</div>
                            <div class="divide"></div>
                            <div class="content" v-html="element.content"></div>
                        </div>
                    </transition>
                    
                </div>
            </div>
        </div>
    `,
    props: ['elements', 'links'],
    data() {
        return {
            id: 'root',
            to: 0,
        };
    },
    computed: {
        element() {
            return this.elements.find(x => x.id === this.id);
        },
        transitionName() {
            switch(this.to) {
                case 0: return 'slide-center';
                case 1: return 'slide-top';
                case 2: return 'slide-right';
                case 3: return 'slide-bottom';
                case 4: return 'slide-left';
            }
        }
    },
    methods: {
        editMode() {
            Bus.$emit('editMode');
        },
        direction(nodeId) {
            switch (nodeId) {
                case 1:
                    return 'Top';
                case 2:
                    return 'Right';
                case 3:
                    return 'Bottom';
                case 4:
                    return 'Left';
            }
        },
        change(nodeId) {
            const node = this.element.nodes.find(x => x.id === nodeId);
            if (!node.linkId) return;

            this.to = nodeId;
            const link = this.links.find(x => x.id === node.linkId);
            if (link.from.element === this.element) {
                this.id = link.to.element.id;
            } else {
                this.id = link.from.element.id;
            }
        },

        keydown(e) {
            if (e.key === '1' || e.key === '2' || e.key === '3' || e.key === '4') {
                e.preventDefault();
                const nodeId = parseInt(e.key);
                this.change(nodeId);
            }
        },
    },
    mounted() {
        this.$refs.view.requestFullscreen();
        document.addEventListener('keydown', this.keydown);
    },
    destroyed() {
        document.removeEventListener('keydown', this.keydown);
    },
});