function nameVerification(value){
    if(value.length == 0 || value.length>150 || value === false || value === true){
        return false
    }
    return true
}

function commentVerification(value){
    if(value.length>1000 || value === false || value === true){
        return false
    }
    return true
}
function priorityVerification(value){
    if(value != 1 && value != 2 && value != 3){
        return false
    }
    return true
}
function stateVerification(value){
    if(value != 1 && value != 2 && value != 3 && value != 4){
        return false
    }
    return true
}
function dateVerification(value){
    let today = new Date;
    let dateToCompare = new Date(value)
    if(dateToCompare < today || value === false || value === true){
        return false
    }
    return true
}

export{nameVerification,   commentVerification, priorityVerification , dateVerification, stateVerification}