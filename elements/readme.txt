ELEMENTS are essentially widgets that can be placed onto slides. They are written in html/javascript/css and are placed ontop of a photo background by the designer script. ELEMENTS should be scalable at various aspect ratios, as the designer script will allow the user to give the element any desired width/height/location.

All ELEMENTS must have a *.html extension (not *.htm, *.HTML, *.HTM).

If any part of the ELEMENTS' code that will need to be unique (assuming the user will generate multiple instances of this element in the final presentation) should be appended with a uuid. The designer script parses the code to add uuids where necessary. To append a uuid to any location in the ELEMENTS' code, simply write the locator: "Uuid32" (no quotes).