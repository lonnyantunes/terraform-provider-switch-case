variable "expression" {
    description = "The string that you want to compare with your different cases of strings"
    default = ""
}

variable "cases" {
    description = "The strings you want to compare with the provided expression"
    default = {
        "" = {
            message = "You have to write and set your custom cases."
        }
    }
}