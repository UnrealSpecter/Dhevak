//store default file input
var fileInput;

//onload attach onchange handler to the input
window.onload = function () {
    //store the default file input
    fileInput = document.getElementById('image_url');
    //attach first change handler to first input
    attachOnChangeHandler(fileInput);
};

//pass element to attach function which dynamically attaches a onchange function to the element
function attachOnChangeHandler(element){
    element.onchange = function () {
        appendNewFileInput(this);
    };
}

//after the onchange function is
function appendNewFileInput(element){

    //store last element the new one gets appended after this one
    var lastElement     = $('.image-upload').last();

    //clone it so you can append a new one
    var clone           = lastElement.clone();

    //get the last file input
    var newFileInput    = clone.children()[1];

    //reset the value so it's an empty file input
    $(newFileInput).get(0).value = "";
    $(newFileInput).attr('class', 'image[]')
    //insert the clone after the last file input
    clone.insertAfter(lastElement);

    //attach onchange handler to the new input.
    attachOnChangeHandler(newFileInput);
}
