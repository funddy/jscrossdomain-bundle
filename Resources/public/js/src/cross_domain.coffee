class FUNDDY.CrossDomain

  constructor: (@$, crossDomainUrl) ->
    @base = if (crossDomainUrl) then crossDomainUrl else "/cross-domain"
    @base += "?url="

  get: (url) ->
    @$.get(@base + encodeURIComponent(url))