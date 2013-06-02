describe "CrossDomain", ->

  $ =
    get: sinon.spy()

  it "generates default cross domain url", ->
    cd = new FUNDDY.CrossDomain($)
    cd.get("http://funddy.com/?foo=var")
    expect($.get.calledWith("/cross-domain?url=http%3A%2F%2Ffunddy.com%2F%3Ffoo%3Dvar")).to.be.ok()

  it "generates custom cross domain url", ->
    cd = new FUNDDY.CrossDomain($, "/app.php/cross-domain")
    cd.get("http://funddy.com/?foo=var")
    expect($.get.calledWith("/app.php/cross-domain?url=http%3A%2F%2Ffunddy.com%2F%3Ffoo%3Dvar")).to.be.ok()