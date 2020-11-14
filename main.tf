locals {
    selected_case = lookup(var.cases, var.expression, "Expression not found : it cannot be null or empty.")
}
