---
title: {{ title .Name }}
weight:
icon: /products/{{ lower .Name }}/images/icon.svg
description_short:

stylesheets: [
    "/styles/style_common.css",
    "/styles/products/style_{{ lower (replace .Name "-" "_") }}.css"
]
---

