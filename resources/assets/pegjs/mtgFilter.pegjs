start
  = summand:summand ' '* { return Boolean(summand); }

summand
  = left:faktor " or " right:summand { return left || right; }
  / faktor

faktor
  = left:token ' and ' right:faktor { return left && right; }
  / left:token ' '+ right:faktor { return left && right; }
  / token

token
  = boolean
  / "(" summand:summand ")" { return summand; }

boolean "boolean"
  = 'true' {return true;} / 'false' { return false; }