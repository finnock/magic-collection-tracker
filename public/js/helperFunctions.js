function sf_sortNumberUp(cardA, cardB) {
    return (parseInt(cardA.number) - parseInt(cardB.number));
}

function sf_sortCmcUp(cardA, cardB) {
    return (parseInt(cardA.cmcSort) - parseInt(cardB.cmcSort));
}

function sf_sortNone(cardA, cardB) {
    return 0;
}

function sf_sortColor(cardA, cardB) {
    return (sf_sortColor_colorValueAssign(cardA) - sf_sortColor_colorValueAssign(cardB));
}

function sf_sortColor_colorValueAssign(card) {
    if('colors' in card.meta){
        if(card.meta.colors.length == 1){
            if(_.includes(card.meta.colors, 'White')){ return 0; }
            if(_.includes(card.meta.colors, 'Blue' )){ return 1; }
            if(_.includes(card.meta.colors, 'Black')){ return 2; }
            if(_.includes(card.meta.colors, 'Red'  )){ return 3; }
            if(_.includes(card.meta.colors, 'Green')){ return 4; }
        }
        if(card.meta.colors.length == 2) {
            if(_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Blue')){ return 5; }
            if(_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Black')){ return 6; }
            if(_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Red')){ return 7; }
            if(_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'Green')){ return 8; }
            if(_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'White')){ return 9; }

            if(_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Black')){ return 10; }
            if(_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Red')){ return 11; }
            if(_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Green')){ return 12; }
            if(_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'White')){ return 13; }
            if(_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'Blue')){ return 14; }
        }
        if(card.meta.colors.length >= 3) {
            return 15;
        }
    }else{
        if(_.includes(card.meta.types, 'Land')){
            return 17;
        }else{
            return 16;
        }
    }
}

function peg_color(colorChar){
    if(colorChar === 'w')
        return 'White';
    if(colorChar === 'u')
        return 'Blue';
    if(colorChar === 'r')
        return 'Red';
    if(colorChar === 'b')
        return 'Black';
    if(colorChar === 'g')
        return 'Green';
}

function peg_canPay(manaCost, ressource){
    var reg = /{([0-9WUBRG/]*[WUBRG])}/g;
    while(subCost = reg.exec(manaCost)){
        var payable = false;
        subCost = subCost[1].split('/');
        for(var i=0; i<subCost.length; i++){
            if (_.includes(ressource, subCost[i]))
                payable = true;
        }
        if(!payable)
            return false;
    }
    return true;
}