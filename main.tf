locals {
    selected_case = lookup(var.cases, var.expression, "Expression '(${var.expression})' not found in cases !")
}
