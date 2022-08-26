import Alpine from "alpinejs"
import Mask from "@alpinejs/mask"
import Focus from "@alpinejs/focus"
import Collapse from "@alpinejs/collapse"
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'

Alpine.plugin(Mask)
Alpine.plugin(Focus)
Alpine.plugin(Collapse)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(FormsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()
