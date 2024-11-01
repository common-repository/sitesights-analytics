
(() => {

    MDAL.pageView({
        "Absolute": null,
        "ClientId": null
    });

    const EventTracker = class EventTracker {

        constructor() {

            this.init();

        }

        init() {

            let emitters = this.getEventEmitters();

            for(let e = 0; e < emitters.length; e++) {

                let emitter = emitters[e];
                this.initEmitter(emitter);

            }

        }

        initEmitter(emitter) {

            let classes = emitter.classList;
            let params = [];
            let evtName = null;
            let paramSet = { };

            for(let e = 0; e < classes.length; e++) {

                let cls = classes[e];

                if(cls.startsWith("sitesights_event_name--")) {

                    let name = cls.split("--");
                    if(name.length != 2) continue;

                    evtName = name[1];

                } else if(cls.startsWith("sitesights_event_param--")) {

                    let parts = cls.split("--");
                    if(parts.length != 3) continue;

                    let placer = parts[1];
                    let paramName = parts[2];

                    if(paramName.trim().length == 0) continue;

                    if(!paramSet.hasOwnProperty(placer)) {

                        paramSet[placer] = paramName;

                    } else {

                        params.push({
                            "Name": paramName,
                            "Value": paramSet[placer]
                        });

                        delete paramSet[placer];

                    }

                } else if(cls.startsWith("sitesights_event_value--")) {

                    let parts = cls.split("--");
                    if(parts.length != 3) continue;

                    let placer = parts[1];
                    let paramValue = parts[2];

                    if(paramValue.trim().length == 0) continue;

                    if(!paramSet.hasOwnProperty(placer)) {

                        paramSet[placer] = paramValue;

                    } else {

                        params.push({
                            "Name": paramSet[placer],
                            "Value": paramValue
                        });

                        delete paramSet[placer];

                    }

                }

            }

            if(evtName != null) {
                emitter.addEventListener("click", this.onEventEmitterClick.bind(this, evtName, params));
            }

        }

        onEventEmitterClick(evtName, params) {

            MDAL.event({
                "Name": evtName,
                "ClientId": null,
                "Parameters": params
            });

        }

        getEventEmitters() {

            return document.querySelectorAll("[class*='sitesights_event_name']");

        }

    }

    const initialize = () => {

        MDAL.WordpressEventTracker = new EventTracker();

    };

    if(document.readyState != "loading") {
        initialize();
    } else {
        window.addEventListener("DOMContentLoaded", () => {
            initialize();
        });
    }

})();