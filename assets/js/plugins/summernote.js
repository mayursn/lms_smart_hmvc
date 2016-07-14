! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(window.jQuery)
}(function(e) {
    "function" != typeof Array.prototype.reduce && (Array.prototype.reduce = function(e, t) {
        var n, o, i = this.length >>> 0,
            r = !1;
        for (1 < arguments.length && (o = t, r = !0), n = 0; i > n; ++n) this.hasOwnProperty(n) && (r ? o = e(o, this[n], n, this) : (o = this[n], r = !0));
        if (!r) throw new TypeError("Reduce of empty array with no initial value");
        return o
    }), "function" != typeof Array.prototype.filter && (Array.prototype.filter = function(e) {
        if (void 0 === this || null === this) throw new TypeError;
        var t = Object(this),
            n = t.length >>> 0;
        if ("function" != typeof e) throw new TypeError;
        for (var o = [], i = arguments.length >= 2 ? arguments[1] : void 0, r = 0; n > r; r++)
            if (r in t) {
                var a = t[r];
                e.call(i, a, r, t) && o.push(a)
            }
        return o
    });
    var t, n = "function" == typeof define && define.amd,
        o = function(t) {
            var n = "Comic Sans MS" === t ? "Courier New" : "Comic Sans MS",
                o = e("<div>").css({
                    position: "absolute",
                    left: "-9999px",
                    top: "-9999px",
                    fontSize: "200px"
                }).text("mmmmmmmmmwwwwwww").appendTo(document.body),
                i = o.css("fontFamily", n).width(),
                r = o.css("fontFamily", t + "," + n).width();
            return o.remove(), i !== r
        },
        i = {
            isMac: navigator.appVersion.indexOf("Mac") > -1,
            isMSIE: navigator.userAgent.indexOf("MSIE") > -1 || navigator.userAgent.indexOf("Trident") > -1,
            isFF: navigator.userAgent.indexOf("Firefox") > -1,
            jqueryVersion: parseFloat(e.fn.jquery),
            isSupportAmd: n,
            hasCodeMirror: n ? require.specified("CodeMirror") : !!window.CodeMirror,
            isFontInstalled: o,
            isW3CRangeSupport: !!document.createRange
        },
        r = function() {
            var t = function(e) {
                    return function(t) {
                        return e === t
                    }
                },
                n = function(e, t) {
                    return e === t
                },
                o = function(e) {
                    return function(t, n) {
                        return t[e] === n[e]
                    }
                },
                i = function() {
                    return !0
                },
                r = function() {
                    return !1
                },
                a = function(e) {
                    return function() {
                        return !e.apply(e, arguments)
                    }
                },
                s = function(e, t) {
                    return function(n) {
                        return e(n) && t(n)
                    }
                },
                l = function(e) {
                    return e
                },
                d = 0,
                u = function(e) {
                    var t = ++d + "";
                    return e ? e + t : t
                },
                c = function(t) {
                    var n = e(document);
                    return {
                        top: t.top + n.scrollTop(),
                        left: t.left + n.scrollLeft(),
                        width: t.right - t.left,
                        height: t.bottom - t.top
                    }
                },
                f = function(e) {
                    var t = {};
                    for (var n in e) e.hasOwnProperty(n) && (t[e[n]] = n);
                    return t
                };
            return {
                eq: t,
                eq2: n,
                peq2: o,
                ok: i,
                fail: r,
                self: l,
                not: a,
                and: s,
                uniqueId: u,
                rect2bnd: c,
                invertObject: f
            }
        }(),
        a = function() {
            var t = function(e) {
                    return e[0]
                },
                n = function(e) {
                    return e[e.length - 1]
                },
                o = function(e) {
                    return e.slice(0, e.length - 1)
                },
                i = function(e) {
                    return e.slice(1)
                },
                a = function(e, t) {
                    for (var n = 0, o = e.length; o > n; n++) {
                        var i = e[n];
                        if (t(i)) return i
                    }
                },
                s = function(e, t) {
                    for (var n = 0, o = e.length; o > n; n++)
                        if (!t(e[n])) return !1;
                    return !0
                },
                l = function(t, n) {
                    return -1 !== e.inArray(n, t)
                },
                d = function(e, t) {
                    return t = t || r.self, e.reduce(function(e, n) {
                        return e + t(n)
                    }, 0)
                },
                u = function(e) {
                    for (var t = [], n = -1, o = e.length; ++n < o;) t[n] = e[n];
                    return t
                },
                c = function(e, o) {
                    if (!e.length) return [];
                    var r = i(e);
                    return r.reduce(function(e, t) {
                        var i = n(e);
                        return o(n(i), t) ? i[i.length] = t : e[e.length] = [t], e
                    }, [
                        [t(e)]
                    ])
                },
                f = function(e) {
                    for (var t = [], n = 0, o = e.length; o > n; n++) e[n] && t.push(e[n]);
                    return t
                },
                h = function(e) {
                    for (var t = [], n = 0, o = e.length; o > n; n++) l(t, e[n]) || t.push(e[n]);
                    return t
                };
            return {
                head: t,
                last: n,
                initial: o,
                tail: i,
                find: a,
                contains: l,
                all: s,
                sum: d,
                from: u,
                clusterBy: c,
                compact: f,
                unique: h
            }
        }(),
        s = String.fromCharCode(160),
        l = "\ufeff",
        d = function() {
            var t = function(t) {
                    return t && e(t).hasClass("note-editable")
                },
                n = function(t) {
                    return t && e(t).hasClass("note-control-sizing")
                },
                o = function(t) {
                    var n;
                    if (t.hasClass("note-air-editor")) {
                        var o = a.last(t.attr("id").split("-"));
                        return n = function(t) {
                            return function() {
                                return e(t + o)
                            }
                        }, {
                            editor: function() {
                                return t
                            },
                            editable: function() {
                                return t
                            },
                            popover: n("#note-popover-"),
                            handle: n("#note-handle-"),
                            dialog: n("#note-dialog-")
                        }
                    }
                    return n = function(e) {
                        return function() {
                            return t.find(e)
                        }
                    }, {
                        editor: function() {
                            return t
                        },
                        dropzone: n(".note-dropzone"),
                        toolbar: n(".note-toolbar"),
                        editable: n(".note-editable"),
                        codable: n(".note-codable"),
                        statusbar: n(".note-statusbar"),
                        popover: n(".note-popover"),
                        handle: n(".note-handle"),
                        dialog: n(".note-dialog")
                    }
                },
                u = function(e) {
                    return e = e.toUpperCase(),
                        function(t) {
                            return t && t.nodeName.toUpperCase() === e
                        }
                },
                c = function(e) {
                    return e && 3 === e.nodeType
                },
                f = function(e) {
                    return e && /^BR|^IMG|^HR/.test(e.nodeName.toUpperCase())
                },
                h = function(e) {
                    return t(e) ? !1 : e && /^DIV|^P|^LI|^H[1-7]/.test(e.nodeName.toUpperCase())
                },
                p = u("LI"),
                v = function(e) {
                    return h(e) && !p(e)
                },
                g = function(e) {
                    return !y(e) && !m(e) && !h(e)
                },
                m = function(e) {
                    return e && /^UL|^OL/.test(e.nodeName.toUpperCase())
                },
                b = function(e) {
                    return e && /^TD|^TH/.test(e.nodeName.toUpperCase())
                },
                C = u("BLOCKQUOTE"),
                y = function(e) {
                    return b(e) || C(e) || t(e)
                },
                w = u("A"),
                k = function(e) {
                    return g(e) && !!E(e, h)
                },
                T = function(e) {
                    return g(e) && !E(e, h)
                },
                x = u("BODY"),
                N = i.isMSIE ? "&nbsp;" : "<br>",
                S = function(e) {
                    return c(e) ? e.nodeValue.length : e.childNodes.length
                },
                L = function(e) {
                    var t = S(e);
                    return 0 === t ? !0 : d.isText(e) || 1 !== t || e.innerHTML !== N ? !1 : !0
                },
                F = function(e) {
                    f(e) || S(e) || (e.innerHTML = N)
                },
                E = function(e, n) {
                    for (; e;) {
                        if (n(e)) return e;
                        if (t(e)) break;
                        e = e.parentNode
                    }
                    return null
                },
                M = function(e, n) {
                    n = n || r.fail;
                    var o = [];
                    return E(e, function(e) {
                        return t(e) || o.push(e), n(e)
                    }), o
                },
                R = function(e, t) {
                    var n = M(e);
                    return a.last(n.filter(t))
                },
                I = function(t, n) {
                    for (var o = M(t), i = n; i; i = i.parentNode)
                        if (e.inArray(i, o) > -1) return i;
                    return null
                },
                A = function(e, t) {
                    t = t || r.fail;
                    for (var n = []; e && !t(e);) n.push(e), e = e.previousSibling;
                    return n
                },
                P = function(e, t) {
                    t = t || r.fail;
                    for (var n = []; e && !t(e);) n.push(e), e = e.nextSibling;
                    return n
                },
                H = function(e, t) {
                    var n = [];
                    return t = t || r.ok,
                        function o(i) {
                            e !== i && t(i) && n.push(i);
                            for (var r = 0, a = i.childNodes.length; a > r; r++) o(i.childNodes[r])
                        }(e), n
                },
                D = function(t, n) {
                    var o = t.parentNode,
                        i = e("<" + n + ">")[0];
                    return o.insertBefore(i, t), i.appendChild(t), i
                },
                U = function(e, t) {
                    var n = t.nextSibling,
                        o = t.parentNode;
                    return n ? o.insertBefore(e, n) : o.appendChild(e), e
                },
                B = function(t, n) {
                    return e.each(n, function(e, n) {
                        t.appendChild(n)
                    }), t
                },
                z = function(e) {
                    return 0 === e.offset
                },
                O = function(e) {
                    return e.offset === S(e.node)
                },
                j = function(e) {
                    return z(e) || O(e)
                },
                q = function(e, t) {
                    for (; e && e !== t;) {
                        if (0 !== W(e)) return !1;
                        e = e.parentNode
                    }
                    return !0
                },
                K = function(e, t) {
                    for (; e && e !== t;) {
                        if (W(e) !== S(e.parentNode) - 1) return !1;
                        e = e.parentNode
                    }
                    return !0
                },
                W = function(e) {
                    for (var t = 0; e = e.previousSibling;) t += 1;
                    return t
                },
                V = function(e) {
                    return !!(e && e.childNodes && e.childNodes.length)
                },
                _ = function(e, n) {
                    var o, i;
                    if (0 === e.offset) {
                        if (t(e.node)) return null;
                        o = e.node.parentNode, i = W(e.node)
                    } else V(e.node) ? (o = e.node.childNodes[e.offset - 1], i = S(o)) : (o = e.node, i = n ? 0 : e.offset - 1);
                    return {
                        node: o,
                        offset: i
                    }
                },
                J = function(e, n) {
                    var o, i;
                    if (S(e.node) === e.offset) {
                        if (t(e.node)) return null;
                        o = e.node.parentNode, i = W(e.node) + 1
                    } else V(e.node) ? (o = e.node.childNodes[e.offset], i = 0) : (o = e.node, i = n ? S(e.node) : e.offset + 1);
                    return {
                        node: o,
                        offset: i
                    }
                },
                Y = function(e, t) {
                    return e.node === t.node && e.offset === t.offset
                },
                G = function(e) {
                    if (c(e.node) || !V(e.node) || L(e.node)) return !0;
                    var t = e.node.childNodes[e.offset - 1],
                        n = e.node.childNodes[e.offset];
                    return t && !f(t) || n && !f(n) ? !1 : !0
                },
                Q = function(e, t) {
                    for (; e;) {
                        if (t(e)) return e;
                        e = _(e)
                    }
                    return null
                },
                Z = function(e, t) {
                    for (; e;) {
                        if (t(e)) return e;
                        e = J(e)
                    }
                    return null
                },
                X = function(e, t, n, o) {
                    for (var i = e; i && (n(i), !Y(i, t));) {
                        var r = o && e.node !== i.node && t.node !== i.node;
                        i = J(i, r)
                    }
                },
                $ = function(t, n) {
                    var o = M(n, r.eq(t));
                    return e.map(o, W).reverse()
                },
                ee = function(e, t) {
                    for (var n = e, o = 0, i = t.length; i > o; o++) n = n.childNodes.length <= t[o] ? n.childNodes[n.childNodes.length - 1] : n.childNodes[t[o]];
                    return n
                },
                te = function(e, t) {
                    if (c(e.node)) return z(e) ? e.node : O(e) ? e.node.nextSibling : e.node.splitText(e.offset);
                    var n = e.node.childNodes[e.offset],
                        o = U(e.node.cloneNode(!1), e.node);
                    return B(o, P(n)), t || (F(e.node), F(o)), o
                },
                ne = function(e, t, n) {
                    var o = M(t.node, r.eq(e));
                    return o.length ? 1 === o.length ? te(t, n) : o.reduce(function(e, o) {
                        var i = U(o.cloneNode(!1), o);
                        return e === t.node && (e = te(t, n)), B(i, P(e)), n || (F(o), F(i)), i
                    }) : null
                },
                oe = function(e) {
                    return document.createElement(e)
                },
                ie = function(e) {
                    return document.createTextNode(e)
                },
                re = function(e, t) {
                    if (e && e.parentNode) {
                        if (e.removeNode) return e.removeNode(t);
                        var n = e.parentNode;
                        if (!t) {
                            var o, i, r = [];
                            for (o = 0, i = e.childNodes.length; i > o; o++) r.push(e.childNodes[o]);
                            for (o = 0, i = r.length; i > o; o++) n.insertBefore(r[o], e)
                        }
                        n.removeChild(e)
                    }
                },
                ae = function(e, n) {
                    for (; e && !t(e) && n(e);) {
                        var o = e.parentNode;
                        re(e), e = o
                    }
                },
                se = function(e, t) {
                    if (e.nodeName.toUpperCase() === t.toUpperCase()) return e;
                    var n = oe(t);
                    return e.style.cssText && (n.style.cssText = e.style.cssText), B(n, a.from(e.childNodes)), U(n, e), re(e), n
                },
                le = u("TEXTAREA"),
                de = function(t, n) {
                    var o = le(t[0]) ? t.val() : t.html();
                    if (n) {
                        var i = /<(\/?)(\b(?!!)[^>\s]*)(.*?)(\s*\/?>)/g;
                        o = o.replace(i, function(e, t, n) {
                            n = n.toUpperCase();
                            var o = /^DIV|^TD|^TH|^P|^LI|^H[1-7]/.test(n) && !!t,
                                i = /^BLOCKQUOTE|^TABLE|^TBODY|^TR|^HR|^UL|^OL/.test(n);
                            return e + (o || i ? "\n" : "")
                        }), o = e.trim(o)
                    }
                    return o
                },
                ue = function(e) {
                    var t = e.val();
                    return t.replace(/[\n\r]/g, "")
                };
            return {
                NBSP_CHAR: s,
                ZERO_WIDTH_NBSP_CHAR: l,
                blank: N,
                emptyPara: "<p>" + N + "</p>",
                isEditable: t,
                isControlSizing: n,
                buildLayoutInfo: o,
                isText: c,
                isPara: h,
                isPurePara: v,
                isInline: g,
                isBodyInline: T,
                isBody: x,
                isParaInline: k,
                isList: m,
                isTable: u("TABLE"),
                isCell: b,
                isBlockquote: C,
                isBodyContainer: y,
                isAnchor: w,
                isDiv: u("DIV"),
                isLi: p,
                isSpan: u("SPAN"),
                isB: u("B"),
                isU: u("U"),
                isS: u("S"),
                isI: u("I"),
                isImg: u("IMG"),
                isTextarea: le,
                isEmpty: L,
                isEmptyAnchor: r.and(w, L),
                nodeLength: S,
                isLeftEdgePoint: z,
                isRightEdgePoint: O,
                isEdgePoint: j,
                isLeftEdgeOf: q,
                isRightEdgeOf: K,
                prevPoint: _,
                nextPoint: J,
                isSamePoint: Y,
                isVisiblePoint: G,
                prevPointUntil: Q,
                nextPointUntil: Z,
                walkPoint: X,
                ancestor: E,
                listAncestor: M,
                lastAncestor: R,
                listNext: P,
                listPrev: A,
                listDescendant: H,
                commonAncestor: I,
                wrap: D,
                insertAfter: U,
                appendChildNodes: B,
                position: W,
                hasChildren: V,
                makeOffsetPath: $,
                fromOffsetPath: ee,
                splitTree: ne,
                create: oe,
                createText: ie,
                remove: re,
                removeWhile: ae,
                replace: se,
                html: de,
                value: ue
            }
        }(),
        u = function() {
            var t = function(e, t) {
                    var n, o, i = e.parentElement(),
                        r = document.body.createTextRange(),
                        s = a.from(i.childNodes);
                    for (n = 0; n < s.length; n++)
                        if (!d.isText(s[n])) {
                            if (r.moveToElementText(s[n]), r.compareEndPoints("StartToStart", e) >= 0) break;
                            o = s[n]
                        }
                    if (0 !== n && d.isText(s[n - 1])) {
                        var l = document.body.createTextRange(),
                            u = null;
                        l.moveToElementText(o || i), l.collapse(!o), u = o ? o.nextSibling : i.firstChild;
                        var c = e.duplicate();
                        c.setEndPoint("StartToStart", l);
                        for (var f = c.text.replace(/[\r\n]/g, "").length; f > u.nodeValue.length && u.nextSibling;) f -= u.nodeValue.length, u = u.nextSibling;
                        u.nodeValue;
                        t && u.nextSibling && d.isText(u.nextSibling) && f === u.nodeValue.length && (f -= u.nodeValue.length, u = u.nextSibling), i = u, n = f
                    }
                    return {
                        cont: i,
                        offset: n
                    }
                },
                n = function(e) {
                    var t = function(e, n) {
                            var o, i;
                            if (d.isText(e)) {
                                var s = d.listPrev(e, r.not(d.isText)),
                                    l = a.last(s).previousSibling;
                                o = l || e.parentNode, n += a.sum(a.tail(s), d.nodeLength), i = !l
                            } else {
                                if (o = e.childNodes[n] || e, d.isText(o)) return t(o, 0);
                                n = 0, i = !1
                            }
                            return {
                                node: o,
                                collapseToStart: i,
                                offset: n
                            }
                        },
                        n = document.body.createTextRange(),
                        o = t(e.node, e.offset);
                    return n.moveToElementText(o.node), n.collapse(o.collapseToStart), n.moveStart("character", o.offset), n
                },
                o = function(t, s, l, u) {
                    this.sc = t, this.so = s, this.ec = l, this.eo = u;
                    var c = function() {
                        if (i.isW3CRangeSupport) {
                            var e = document.createRange();
                            return e.setStart(t, s), e.setEnd(l, u), e
                        }
                        var o = n({
                            node: t,
                            offset: s
                        });
                        return o.setEndPoint("EndToEnd", n({
                            node: l,
                            offset: u
                        })), o
                    };
                    this.getPoints = function() {
                        return {
                            sc: t,
                            so: s,
                            ec: l,
                            eo: u
                        }
                    }, this.getStartPoint = function() {
                        return {
                            node: t,
                            offset: s
                        }
                    }, this.getEndPoint = function() {
                        return {
                            node: l,
                            offset: u
                        }
                    }, this.select = function() {
                        var e = c();
                        if (i.isW3CRangeSupport) {
                            var t = document.getSelection();
                            t.rangeCount > 0 && t.removeAllRanges(), t.addRange(e)
                        } else e.select()
                    }, this.normalize = function() {
                        var e = function(e) {
                                return d.isVisiblePoint(e) || (d.isLeftEdgePoint(e) ? e = d.nextPointUntil(e, d.isVisiblePoint) : d.isRightEdgePoint(e) && (e = d.prevPointUntil(e, d.isVisiblePoint))), e
                            },
                            t = e(this.getStartPoint()),
                            n = e(this.getStartPoint());
                        return new o(t.node, t.offset, n.node, n.offset)
                    }, this.nodes = function(e, t) {
                        e = e || r.ok;
                        var n = t && t.includeAncestor,
                            o = t && t.fullyContains,
                            i = this.getStartPoint(),
                            s = this.getEndPoint(),
                            l = [],
                            u = [];
                        return d.walkPoint(i, s, function(t) {
                            if (!d.isEditable(t.node)) {
                                var i;
                                o ? (d.isLeftEdgePoint(t) && u.push(t.node), d.isRightEdgePoint(t) && a.contains(u, t.node) && (i = t.node)) : i = n ? d.ancestor(t.node, e) : t.node, i && e(i) && l.push(i)
                            }
                        }, !0), a.unique(l)
                    }, this.commonAncestor = function() {
                        return d.commonAncestor(t, l)
                    }, this.expand = function(e) {
                        var n = d.ancestor(t, e),
                            i = d.ancestor(l, e);
                        if (!n && !i) return new o(t, s, l, u);
                        var r = this.getPoints();
                        return n && (r.sc = n, r.so = 0), i && (r.ec = i, r.eo = d.nodeLength(i)), new o(r.sc, r.so, r.ec, r.eo)
                    }, this.collapse = function(e) {
                        return e ? new o(t, s, t, s) : new o(l, u, l, u)
                    }, this.splitText = function() {
                        var e = t === l,
                            n = this.getPoints();
                        return d.isText(l) && !d.isEdgePoint(this.getEndPoint()) && l.splitText(u), d.isText(t) && !d.isEdgePoint(this.getStartPoint()) && (n.sc = t.splitText(s), n.so = 0, e && (n.ec = n.sc, n.eo = u - s)), new o(n.sc, n.so, n.ec, n.eo)
                    }, this.deleteContents = function() {
                        if (this.isCollapsed()) return this;
                        var t = this.splitText(),
                            n = t.nodes(null, {
                                fullyContains: !0
                            }),
                            i = d.prevPointUntil(t.getStartPoint(), function(e) {
                                return !a.contains(n, e.node)
                            }),
                            r = [];
                        return e.each(n, function(e, t) {
                            var n = t.parentNode;
                            i.node !== n && 1 === d.nodeLength(n) && r.push(n), d.remove(t, !1)
                        }), e.each(r, function(e, t) {
                            d.remove(t, !1)
                        }), new o(i.node, i.offset, i.node, i.offset)
                    };
                    var f = function(e) {
                        return function() {
                            var n = d.ancestor(t, e);
                            return !!n && n === d.ancestor(l, e)
                        }
                    };
                    this.isOnEditable = f(d.isEditable), this.isOnList = f(d.isList), this.isOnAnchor = f(d.isAnchor), this.isOnCell = f(d.isCell), this.isLeftEdgeOf = function(e) {
                        if (!d.isLeftEdgePoint(this.getStartPoint())) return !1;
                        var t = d.ancestor(this.sc, e);
                        return t && d.isLeftEdgeOf(this.sc, t)
                    }, this.isCollapsed = function() {
                        return t === l && s === u
                    }, this.wrapBodyInlineWithPara = function() {
                        if (d.isBodyContainer(t) && d.isEmpty(t)) return t.innerHTML = d.emptyPara, new o(t.firstChild, 0);
                        if (!d.isInline(t) || d.isParaInline(t)) return this;
                        var e = d.listAncestor(t, r.not(d.isInline)),
                            n = a.last(e);
                        d.isInline(n) || (n = e[e.length - 2] || t.childNodes[s]);
                        var i = d.listPrev(n, d.isParaInline).reverse();
                        if (i = i.concat(d.listNext(n.nextSibling, d.isParaInline)), i.length) {
                            var l = d.wrap(a.head(i), "p");
                            d.appendChildNodes(l, a.tail(i))
                        }
                        return this
                    }, this.insertNode = function(e, t) {
                        var n, o, i, r = this.wrapBodyInlineWithPara(),
                            s = r.getStartPoint();
                        if (t) o = d.isPara(s.node) ? s.node : s.node.parentNode, i = d.isPara(s.node) ? s.node.childNodes[s.offset] : d.splitTree(s.node, s);
                        else {
                            var l = d.listAncestor(s.node, d.isBodyContainer),
                                u = a.last(l) || s.node;
                            d.isBodyContainer(u) ? (n = l[l.length - 2], o = u) : (n = u, o = n.parentNode), i = n && d.splitTree(n, s)
                        }
                        return i ? i.parentNode.insertBefore(e, i) : o.appendChild(e), e
                    }, this.toString = function() {
                        var e = c();
                        return i.isW3CRangeSupport ? e.toString() : e.text
                    }, this.bookmark = function(e) {
                        return {
                            s: {
                                path: d.makeOffsetPath(e, t),
                                offset: s
                            },
                            e: {
                                path: d.makeOffsetPath(e, l),
                                offset: u
                            }
                        }
                    }, this.getClientRects = function() {
                        var e = c();
                        return e.getClientRects()
                    }
                };
            return {
                create: function(e, n, r, a) {
                    if (arguments.length) 2 === arguments.length && (r = e, a = n);
                    else if (i.isW3CRangeSupport) {
                        var s = document.getSelection();
                        if (0 === s.rangeCount) return null;
                        if (d.isBody(s.anchorNode)) return null;
                        var l = s.getRangeAt(0);
                        e = l.startContainer, n = l.startOffset, r = l.endContainer, a = l.endOffset
                    } else {
                        var u = document.selection.createRange(),
                            c = u.duplicate();
                        c.collapse(!1);
                        var f = u;
                        f.collapse(!0);
                        var h = t(f, !0),
                            p = t(c, !1);
                        d.isText(h.node) && d.isLeftEdgePoint(h) && d.isTextNode(p.node) && d.isRightEdgePoint(p) && p.node.nextSibling === h.node && (h = p), e = h.cont, n = h.offset, r = p.cont, a = p.offset
                    }
                    return new o(e, n, r, a)
                },
                createFromNode: function(e) {
                    return this.create(e, 0, e, 1)
                },
                createFromBookmark: function(e, t) {
                    var n = d.fromOffsetPath(e, t.s.path),
                        i = t.s.offset,
                        r = d.fromOffsetPath(e, t.e.path),
                        a = t.e.offset;
                    return new o(n, i, r, a)
                }
            }
        }(),
        c = {
            version: "0.5.10",
            options: {
                width: null,
                height: null,
                minHeight: null,
                maxHeight: null,
                focus: !1,
                tabsize: 4,
                styleWithSpan: !0,
                disableLinkTarget: !1,
                disableDragAndDrop: !1,
                disableResizeEditor: !1,
                shortcuts: !0,
                codemirror: {
                    mode: "text/html",
                    htmlMode: !0,
                    lineNumbers: !0
                },
                lang: "en-US",
                direction: null,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "italic", "underline", "clear"]],
                    ["fontname", ["fontname"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["height", ["height"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture", "hr"]],
                    ["view", ["fullscreen", "codeview"]],
                    ["help", ["help"]]
                ],
                airMode: !1,
                airPopover: [
                    ["color", ["color"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["para", ["ul", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture"]]
                ],
                styleTags: ["p", "blockquote", "pre", "h1", "h2", "h3", "h4", "h5", "h6"],
                defaultFontName: "Helvetica Neue",
                fontNames: ["Arial", "Arial Black", "Comic Sans MS", "Courier New", "Helvetica Neue", "Impact", "Lucida Grande", "Tahoma", "Times New Roman", "Verdana"],
                colors: [
                    ["#000000", "#424242", "#636363", "#9C9C94", "#CEC6CE", "#EFEFEF", "#F7F7F7", "#FFFFFF"],
                    ["#FF0000", "#FF9C00", "#FFFF00", "#00FF00", "#00FFFF", "#0000FF", "#9C00FF", "#FF00FF"],
                    ["#F7C6CE", "#FFE7CE", "#FFEFC6", "#D6EFD6", "#CEDEE7", "#CEE7F7", "#D6D6E7", "#E7D6DE"],
                    ["#E79C9C", "#FFC69C", "#FFE79C", "#B5D6A5", "#A5C6CE", "#9CC6EF", "#B5A5D6", "#D6A5BD"],
                    ["#E76363", "#F7AD6B", "#FFD663", "#94BD7B", "#73A5AD", "#6BADDE", "#8C7BC6", "#C67BA5"],
                    ["#CE0000", "#E79439", "#EFC631", "#6BA54A", "#4A7B8C", "#3984C6", "#634AA5", "#A54A7B"],
                    ["#9C0000", "#B56308", "#BD9400", "#397B21", "#104A5A", "#085294", "#311873", "#731842"],
                    ["#630000", "#7B3900", "#846300", "#295218", "#083139", "#003163", "#21104A", "#4A1031"]
                ],
                lineHeights: ["1.0", "1.2", "1.4", "1.5", "1.6", "1.8", "2.0", "3.0"],
                insertTableMaxSize: {
                    col: 10,
                    row: 10
                },
                oninit: null,
                onfocus: null,
                onblur: null,
                onenter: null,
                onkeyup: null,
                onkeydown: null,
                onImageUpload: null,
                onImageUploadError: null,
                onToolbarClick: null,
                onsubmit: null,
                onCreateLink: function(e) {
                    return -1 !== e.indexOf("@") && -1 === e.indexOf(":") ? e = "mailto:" + e : -1 === e.indexOf("://") && (e = "http://" + e), e
                },
                keyMap: {
                    pc: {
                        ENTER: "insertParagraph",
                        "CTRL+Z": "undo",
                        "CTRL+Y": "redo",
                        TAB: "tab",
                        "SHIFT+TAB": "untab",
                        "CTRL+B": "bold",
                        "CTRL+I": "italic",
                        "CTRL+U": "underline",
                        "CTRL+SHIFT+S": "strikethrough",
                        "CTRL+BACKSLASH": "removeFormat",
                        "CTRL+SHIFT+L": "justifyLeft",
                        "CTRL+SHIFT+E": "justifyCenter",
                        "CTRL+SHIFT+R": "justifyRight",
                        "CTRL+SHIFT+J": "justifyFull",
                        "CTRL+SHIFT+NUM7": "insertUnorderedList",
                        "CTRL+SHIFT+NUM8": "insertOrderedList",
                        "CTRL+LEFTBRACKET": "outdent",
                        "CTRL+RIGHTBRACKET": "indent",
                        "CTRL+NUM0": "formatPara",
                        "CTRL+NUM1": "formatH1",
                        "CTRL+NUM2": "formatH2",
                        "CTRL+NUM3": "formatH3",
                        "CTRL+NUM4": "formatH4",
                        "CTRL+NUM5": "formatH5",
                        "CTRL+NUM6": "formatH6",
                        "CTRL+ENTER": "insertHorizontalRule",
                        "CTRL+K": "showLinkDialog"
                    },
                    mac: {
                        ENTER: "insertParagraph",
                        "CMD+Z": "undo",
                        "CMD+SHIFT+Z": "redo",
                        TAB: "tab",
                        "SHIFT+TAB": "untab",
                        "CMD+B": "bold",
                        "CMD+I": "italic",
                        "CMD+U": "underline",
                        "CMD+SHIFT+S": "strikethrough",
                        "CMD+BACKSLASH": "removeFormat",
                        "CMD+SHIFT+L": "justifyLeft",
                        "CMD+SHIFT+E": "justifyCenter",
                        "CMD+SHIFT+R": "justifyRight",
                        "CMD+SHIFT+J": "justifyFull",
                        "CMD+SHIFT+NUM7": "insertUnorderedList",
                        "CMD+SHIFT+NUM8": "insertOrderedList",
                        "CMD+LEFTBRACKET": "outdent",
                        "CMD+RIGHTBRACKET": "indent",
                        "CMD+NUM0": "formatPara",
                        "CMD+NUM1": "formatH1",
                        "CMD+NUM2": "formatH2",
                        "CMD+NUM3": "formatH3",
                        "CMD+NUM4": "formatH4",
                        "CMD+NUM5": "formatH5",
                        "CMD+NUM6": "formatH6",
                        "CMD+ENTER": "insertHorizontalRule",
                        "CMD+K": "showLinkDialog"
                    }
                }
            },
            lang: {
                "en-US": {
                    font: {
                        bold: "Bold",
                        italic: "Italic",
                        underline: "Underline",
                        clear: "Remove Font Style",
                        height: "Line Height",
                        name: "Font Family"
                    },
                    image: {
                        image: "Picture",
                        insert: "Insert Image",
                        resizeFull: "Resize Full",
                        resizeHalf: "Resize Half",
                        resizeQuarter: "Resize Quarter",
                        floatLeft: "Float Left",
                        floatRight: "Float Right",
                        floatNone: "Float None",
                        shapeRounded: "Shape: Rounded",
                        shapeCircle: "Shape: Circle",
                        shapeThumbnail: "Shape: Thumbnail",
                        shapeNone: "Shape: None",
                        dragImageHere: "Drag image here",
                        dropImage: "Drop image",
                        selectFromFiles: "Select from files",
                        url: "Image URL",
                        remove: "Remove Image"
                    },
                    link: {
                        link: "Link",
                        insert: "Insert Link",
                        unlink: "Unlink",
                        edit: "Edit",
                        textToDisplay: "Text to display",
                        url: "To what URL should this link go?",
                        openInNewWindow: "Open in new window"
                    },
                    table: {
                        table: "Table"
                    },
                    hr: {
                        insert: "Insert Horizontal Rule"
                    },
                    style: {
                        style: "Style",
                        normal: "Normal",
                        blockquote: "Quote",
                        pre: "Code",
                        h1: "Header 1",
                        h2: "Header 2",
                        h3: "Header 3",
                        h4: "Header 4",
                        h5: "Header 5",
                        h6: "Header 6"
                    },
                    lists: {
                        unordered: "Unordered list",
                        ordered: "Ordered list"
                    },
                    options: {
                        help: "Help",
                        fullscreen: "Full Screen",
                        codeview: "Code View"
                    },
                    paragraph: {
                        paragraph: "Paragraph",
                        outdent: "Outdent",
                        indent: "Indent",
                        left: "Align left",
                        center: "Align center",
                        right: "Align right",
                        justify: "Justify full"
                    },
                    color: {
                        recent: "Recent Color",
                        more: "More Color",
                        background: "Background Color",
                        foreground: "Foreground Color",
                        transparent: "Transparent",
                        setTransparent: "Set transparent",
                        reset: "Reset",
                        resetToDefault: "Reset to default"
                    },
                    shortcut: {
                        shortcuts: "Keyboard shortcuts",
                        close: "Close",
                        textFormatting: "Text formatting",
                        action: "Action",
                        paragraphFormatting: "Paragraph formatting",
                        documentStyle: "Document Style"
                    },
                    history: {
                        undo: "Undo",
                        redo: "Redo"
                    }
                }
            }
        },
        f = function() {
            var t = function(t) {
                    return e.Deferred(function(n) {
                        e.extend(new FileReader, {
                            onload: function(e) {
                                var t = e.target.result;
                                n.resolve(t)
                            },
                            onerror: function() {
                                n.reject(this)
                            }
                        }).readAsDataURL(t)
                    }).promise()
                },
                n = function(t, n) {
                    return e.Deferred(function(o) {
                        e("<img>").one("load", function() {
                            o.resolve(e(this))
                        }).one("error abort", function() {
                            o.reject(e(this).detach())
                        }).css({
                            display: "none"
                        }).appendTo(document.body).attr("src", t).attr("data-filename", n)
                    }).promise()
                };
            return {
                readFileAsDataURL: t,
                createImage: n
            }
        }(),
        h = {
            isEdit: function(e) {
                return a.contains([8, 9, 13, 32], e)
            },
            nameFromCode: {
                8: "BACKSPACE",
                9: "TAB",
                13: "ENTER",
                32: "SPACE",
                48: "NUM0",
                49: "NUM1",
                50: "NUM2",
                51: "NUM3",
                52: "NUM4",
                53: "NUM5",
                54: "NUM6",
                55: "NUM7",
                56: "NUM8",
                66: "B",
                69: "E",
                73: "I",
                74: "J",
                75: "K",
                76: "L",
                82: "R",
                83: "S",
                85: "U",
                89: "Y",
                90: "Z",
                191: "SLASH",
                219: "LEFTBRACKET",
                220: "BACKSLASH",
                221: "RIGHTBRACKET"
            }
        },
        p = function() {
            var t = function(t, n) {
                if (i.jqueryVersion < 1.9) {
                    var o = {};
                    return e.each(n, function(e, n) {
                        o[n] = t.css(n)
                    }), o
                }
                return t.css.call(t, n)
            };
            this.stylePara = function(t, n) {
                e.each(t.nodes(d.isPara, {
                    includeAncestor: !0
                }), function(t, o) {
                    e(o).css(n)
                })
            }, this.current = function(n, o) {
                var i = e(d.isText(n.sc) ? n.sc.parentNode : n.sc),
                    r = ["font-family", "font-size", "text-align", "list-style-type", "line-height"],
                    a = t(i, r) || {};
                if (a["font-size"] = parseInt(a["font-size"], 10), a["font-bold"] = document.queryCommandState("bold") ? "bold" : "normal", a["font-italic"] = document.queryCommandState("italic") ? "italic" : "normal", a["font-underline"] = document.queryCommandState("underline") ? "underline" : "normal", a["font-strikethrough"] = document.queryCommandState("strikeThrough") ? "strikethrough" : "normal", a["font-superscript"] = document.queryCommandState("superscript") ? "superscript" : "normal", a["font-subscript"] = document.queryCommandState("subscript") ? "subscript" : "normal", n.isOnList()) {
                    var s = ["circle", "disc", "disc-leading-zero", "square"],
                        l = e.inArray(a["list-style-type"], s) > -1;
                    a["list-style"] = l ? "unordered" : "ordered"
                } else a["list-style"] = "none";
                var u = d.ancestor(n.sc, d.isPara);
                if (u && u.style["line-height"]) a["line-height"] = u.style.lineHeight;
                else {
                    var c = parseInt(a["line-height"], 10) / parseInt(a["font-size"], 10);
                    a["line-height"] = c.toFixed(1)
                }
                return a.image = d.isImg(o) && o, a.anchor = n.isOnAnchor() && d.ancestor(n.sc, d.isAnchor), a.ancestors = d.listAncestor(n.sc, d.isEditable), a.range = n, a
            }
        },
        v = function() {
            this.insertTab = function(e, t, n) {
                var o = d.createText(new Array(n + 1).join(d.NBSP_CHAR));
                t = t.deleteContents(), t.insertNode(o, !0), t = u.create(o, n), t.select()
            }, this.insertParagraph = function() {
                var t = u.create();
                t = t.deleteContents(), t = t.wrapBodyInlineWithPara();
                var n, o = d.ancestor(t.sc, d.isPara);
                if (o) {
                    n = d.splitTree(o, t.getStartPoint());
                    var i = d.listDescendant(o, d.isEmptyAnchor);
                    i = i.concat(d.listDescendant(n, d.isEmptyAnchor)), e.each(i, function(e, t) {
                        d.remove(t)
                    })
                } else {
                    var r = t.sc.childNodes[t.so];
                    n = e(d.emptyPara)[0], r ? t.sc.insertBefore(n, r) : t.sc.appendChild(n)
                }
                u.create(n, 0).normalize().select()
            }
        },
        g = function() {
            this.tab = function(e, t) {
                var n = d.ancestor(e.commonAncestor(), d.isCell),
                    o = d.ancestor(n, d.isTable),
                    i = d.listDescendant(o, d.isCell),
                    r = a[t ? "prev" : "next"](i, n);
                r && u.create(r, 0).select()
            }, this.createTable = function(t, n) {
                for (var o, i = [], r = 0; t > r; r++) i.push("<td>" + d.blank + "</td>");
                o = i.join("");
                for (var a, s = [], l = 0; n > l; l++) s.push("<tr>" + o + "</tr>");
                return a = s.join(""), e('<table class="table table-bordered">' + a + "</table>")[0]
            }
        },
        m = function() {
            this.insertOrderedList = function() {
                this.toggleList("OL")
            }, this.insertUnorderedList = function() {
                this.toggleList("UL")
            }, this.indent = function() {
                var t = this,
                    n = u.create().wrapBodyInlineWithPara(),
                    o = n.nodes(d.isPara, {
                        includeAncestor: !0
                    }),
                    i = a.clusterBy(o, r.peq2("parentNode"));
                e.each(i, function(n, o) {
                    var i = a.head(o);
                    d.isLi(i) ? t.wrapList(o, i.parentNode.nodeName) : e.each(o, function(t, n) {
                        e(n).css("marginLeft", function(e, t) {
                            return (parseInt(t, 10) || 0) + 25
                        })
                    })
                }), n.select()
            }, this.outdent = function() {
                var t = this,
                    n = u.create().wrapBodyInlineWithPara(),
                    o = n.nodes(d.isPara, {
                        includeAncestor: !0
                    }),
                    i = a.clusterBy(o, r.peq2("parentNode"));
                e.each(i, function(n, o) {
                    var i = a.head(o);
                    d.isLi(i) ? t.releaseList([o]) : e.each(o, function(t, n) {
                        e(n).css("marginLeft", function(e, t) {
                            return t = parseInt(t, 10) || 0, t > 25 ? t - 25 : ""
                        })
                    })
                }), n.select()
            }, this.toggleList = function(t) {
                var n = this,
                    o = u.create().wrapBodyInlineWithPara(),
                    i = o.nodes(d.isPara, {
                        includeAncestor: !0
                    }),
                    s = a.clusterBy(i, r.peq2("parentNode"));
                if (a.find(i, d.isPurePara)) e.each(s, function(e, o) {
                    n.wrapList(o, t)
                });
                else {
                    var l = o.nodes(d.isList, {
                        includeAncestor: !0
                    }).filter(function(n) {
                        return !e.nodeName(n, t)
                    });
                    l.length ? e.each(l, function(e, n) {
                        d.replace(n, t)
                    }) : this.releaseList(s, !0)
                }
                o.select()
            }, this.wrapList = function(t, n) {
                var o = a.head(t),
                    i = a.last(t),
                    r = d.isList(o.previousSibling) && o.previousSibling,
                    s = d.isList(i.nextSibling) && i.nextSibling,
                    l = r || d.insertAfter(d.create(n || "UL"), i);
                t = e.map(t, function(e) {
                    return d.isPurePara(e) ? d.replace(e, "LI") : e
                }), d.appendChildNodes(l, t), s && (d.appendChildNodes(l, a.from(s.childNodes)), d.remove(s))
            }, this.releaseList = function(t, n) {
                var o = [];
                return e.each(t, function(t, i) {
                    var r = a.head(i),
                        s = a.last(i),
                        l = n ? d.lastAncestor(r, d.isList) : r.parentNode,
                        u = l.childNodes.length > 1 ? d.splitTree(l, {
                            node: s.parentNode,
                            offset: d.position(s) + 1
                        }, !0) : null,
                        c = d.splitTree(l, {
                            node: r.parentNode,
                            offset: d.position(r)
                        }, !0);
                    i = n ? d.listDescendant(c, d.isLi) : a.from(c.childNodes).filter(d.isLi), (n || !d.isList(l.parentNode)) && (i = e.map(i, function(e) {
                        return d.replace(e, "P")
                    })), e.each(a.from(i).reverse(), function(e, t) {
                        d.insertAfter(t, l)
                    });
                    var f = a.compact([l, c, u]);
                    e.each(f, function(t, n) {
                        var o = [n].concat(d.listDescendant(n, d.isList));
                        e.each(o.reverse(), function(e, t) {
                            d.nodeLength(t) || d.remove(t, !0)
                        })
                    }), o = o.concat(i)
                }), o
            }
        },
        b = function() {
            var t = new p,
                n = new g,
                o = new v,
                r = new m;
            this.createRange = function(e) {
                return e.focus(), u.create()
            }, this.saveRange = function(e, t) {
                e.focus(), e.data("range", u.create()), t && u.create().collapse().select()
            }, this.restoreRange = function(e) {
                var t = e.data("range");
                t && (t.select(), e.focus())
            }, this.currentStyle = function(e) {
                var n = u.create();
                return n ? n.isOnEditable() && t.current(n, e) : !1
            };
            var s = this.triggerOnChange = function(e) {
                var t = e.data("callbacks").onChange;
                t && t(e.html(), e)
            };
            this.undo = function(e) {
                e.data("NoteHistory").undo(), s(e)
            }, this.redo = function(e) {
                e.data("NoteHistory").redo(), s(e)
            };
            for (var l = this.afterCommand = function(e) {
                    e.data("NoteHistory").recordUndo(), s(e)
                }, c = ["bold", "italic", "underline", "strikethrough", "superscript", "subscript", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull", "formatBlock", "removeFormat", "backColor", "foreColor", "insertHorizontalRule", "fontName"], h = 0, b = c.length; b > h; h++) this[c[h]] = function(e) {
                return function(t, n) {
                    document.execCommand(e, !1, n), l(t)
                }
            }(c[h]);
            this.tab = function(e, t) {
                var i = u.create();
                i.isCollapsed() && i.isOnCell() ? n.tab(i) : (o.insertTab(e, i, t.tabsize), l(e))
            }, this.untab = function() {
                var e = u.create();
                e.isCollapsed() && e.isOnCell() && n.tab(e, !0)
            }, this.insertParagraph = function(e) {
                o.insertParagraph(e), l(e)
            }, this.insertOrderedList = function(e) {
                r.insertOrderedList(e), l(e)
            }, this.insertUnorderedList = function(e) {
                r.insertUnorderedList(e), l(e)
            }, this.indent = function(e) {
                r.indent(e), l(e)
            }, this.outdent = function(e) {
                r.outdent(e), l(e)
            }, this.insertImage = function(e, t, n) {
                f.createImage(t, n).then(function(t) {
                    t.css({
                        display: "",
                        width: Math.min(e.width(), t.width())
                    }), u.create().insertNode(t[0]), l(e)
                }).fail(function() {
                    var t = e.data("callbacks");
                    t.onImageUploadError && t.onImageUploadError()
                })
            }, this.insertNode = function(e, t, n) {
                u.create().insertNode(t, n), l(e)
            }, this.insertText = function(e, t) {
                var n = this.createRange(e).insertNode(d.createText(t), !0);
                u.create(n, d.nodeLength(n)).select(), l(e)
            }, this.formatBlock = function(e, t) {
                t = i.isMSIE ? "<" + t + ">" : t, document.execCommand("FormatBlock", !1, t), l(e)
            }, this.formatPara = function(e) {
                this.formatBlock(e, "P"), l(e)
            };
            for (var h = 1; 6 >= h; h++) this["formatH" + h] = function(e) {
                return function(t) {
                    this.formatBlock(t, "H" + e)
                }
            }(h);
            this.fontSize = function(e, t) {
                document.execCommand("fontSize", !1, 3), i.isFF ? e.find("font[size=3]").removeAttr("size").css("font-size", t + "px") : e.find("span").filter(function() {
                    return "medium" === this.style.fontSize
                }).css("font-size", t + "px"), l(e)
            }, this.lineHeight = function(e, n) {
                t.stylePara(u.create(), {
                    lineHeight: n
                }), l(e)
            }, this.unlink = function(e) {
                var t = u.create();
                if (t.isOnAnchor()) {
                    var n = d.ancestor(t.sc, d.isAnchor);
                    t = u.createFromNode(n), t.select(), document.execCommand("unlink"), l(e)
                }
            }, this.createLink = function(t, n, o) {
                var i = n.url,
                    r = n.text,
                    a = n.newWindow,
                    s = n.range;
                o.onCreateLink && (i = o.onCreateLink(i)), s = s.deleteContents();
                var d = s.insertNode(e("<A>" + r + "</A>")[0], !0);
                e(d).attr({
                    href: i,
                    target: a ? "_blank" : ""
                }), u.createFromNode(d).select(), l(t)
            }, this.getLinkInfo = function(t) {
                t.focus();
                var n = u.create().expand(d.isAnchor),
                    o = e(a.head(n.nodes(d.isAnchor)));
                return {
                    range: n,
                    text: n.toString(),
                    isNewWindow: o.length ? "_blank" === o.attr("target") : !0,
                    url: o.length ? o.attr("href") : ""
                }
            }, this.color = function(e, t) {
                var n = JSON.parse(t),
                    o = n.foreColor,
                    i = n.backColor;
                o && document.execCommand("foreColor", !1, o), i && document.execCommand("backColor", !1, i), l(e)
            }, this.insertTable = function(e, t) {
                var o = t.split("x"),
                    i = u.create();
                i = i.deleteContents(), i.insertNode(n.createTable(o[0], o[1])), l(e)
            }, this.floatMe = function(e, t, n) {
                n.css("float", t), l(e)
            }, this.imageShape = function(e, t, n) {
                n.removeClass("img-rounded img-circle img-thumbnail"), t && n.addClass(t)
            }, this.resize = function(e, t, n) {
                n.css({
                    width: 100 * t + "%",
                    height: ""
                }), l(e)
            }, this.resizeTo = function(e, t, n) {
                var o;
                if (n) {
                    var i = e.y / e.x,
                        r = t.data("ratio");
                    o = {
                        width: r > i ? e.x : e.y / r,
                        height: r > i ? e.x * r : e.y
                    }
                } else o = {
                    width: e.x,
                    height: e.y
                };
                t.css(o)
            }, this.removeMedia = function(e, t, n) {
                n.detach(), l(e)
            }
        },
        C = function(e) {
            var t = [],
                n = -1,
                o = e[0],
                i = function() {
                    var t = u.create(),
                        n = {
                            s: {
                                path: [0],
                                offset: 0
                            },
                            e: {
                                path: [0],
                                offset: 0
                            }
                        };
                    return {
                        contents: e.html(),
                        bookmark: t ? t.bookmark(o) : n
                    }
                },
                r = function(t) {
                    null !== t.contents && e.html(t.contents), null !== t.bookmark && u.createFromBookmark(o, t.bookmark).select()
                };
            this.undo = function() {
                n > 0 && (n--, r(t[n]))
            }, this.redo = function() {
                t.length - 1 > n && (n++, r(t[n]))
            }, this.recordUndo = function() {
                n++, t.length > n && (t = t.slice(0, n)), t.push(i())
            }, this.recordUndo()
        },
        y = function() {
            this.update = function(t, n) {
                var o = function(t, n) {
                        t.find(".dropdown-menu li a").each(function() {
                            var t = e(this).data("value") + "" == n + "";
                            this.className = t ? "checked" : ""
                        })
                    },
                    i = function(e, n) {
                        var o = t.find(e);
                        o.toggleClass("active", n())
                    },
                    r = t.find(".note-fontname");
                if (r.length) {
                    var s = n["font-family"];
                    s && (s = a.head(s.split(",")), s = s.replace(/\'/g, ""), r.find(".note-current-fontname").text(s), o(r, s))
                }
                var l = t.find(".note-fontsize");
                l.find(".note-current-fontsize").text(n["font-size"]), o(l, parseFloat(n["font-size"]));
                var d = t.find(".note-height");
                o(d, parseFloat(n["line-height"])), i('button[data-event="bold"]', function() {
                    return "bold" === n["font-bold"]
                }), i('button[data-event="italic"]', function() {
                    return "italic" === n["font-italic"]
                }), i('button[data-event="underline"]', function() {
                    return "underline" === n["font-underline"]
                }), i('button[data-event="strikethrough"]', function() {
                    return "strikethrough" === n["font-strikethrough"]
                }), i('button[data-event="superscript"]', function() {
                    return "superscript" === n["font-superscript"]
                }), i('button[data-event="subscript"]', function() {
                    return "subscript" === n["font-subscript"]
                }), i('button[data-event="justifyLeft"]', function() {
                    return "left" === n["text-align"] || "start" === n["text-align"]
                }), i('button[data-event="justifyCenter"]', function() {
                    return "center" === n["text-align"]
                }), i('button[data-event="justifyRight"]', function() {
                    return "right" === n["text-align"]
                }), i('button[data-event="justifyFull"]', function() {
                    return "justify" === n["text-align"]
                }), i('button[data-event="insertUnorderedList"]', function() {
                    return "unordered" === n["list-style"]
                }), i('button[data-event="insertOrderedList"]', function() {
                    return "ordered" === n["list-style"]
                })
            }, this.updateRecentColor = function(t, n, o) {
                var i = e(t).closest(".note-color"),
                    r = i.find(".note-recent-color"),
                    a = JSON.parse(r.attr("data-value"));
                a[n] = o, r.attr("data-value", JSON.stringify(a));
                var s = "backColor" === n ? "background-color" : "color";
                r.find("i").css(s, o)
            }
        },
        w = function() {
            var e = new y;
            this.update = function(t, n) {
                e.update(t, n)
            }, this.updateRecentColor = function(t, n, o) {
                e.updateRecentColor(t, n, o)
            }, this.activate = function(e) {
                e.find("button").not('button[data-event="codeview"]').removeClass("disabled")
            }, this.deactivate = function(e) {
                e.find("button").not('button[data-event="codeview"]').addClass("disabled")
            }, this.updateFullscreen = function(e, t) {
                var n = e.find('button[data-event="fullscreen"]');
                n.toggleClass("active", t)
            }, this.updateCodeview = function(e, t) {
                var n = e.find('button[data-event="codeview"]');
                n.toggleClass("active", t)
            }
        },
        k = function() {
            var t = new y,
                n = function(t, n) {
                    var o = e(t),
                        i = n ? o.offset() : o.position(),
                        r = o.outerHeight(!0);
                    return {
                        left: i.left,
                        top: i.top + r
                    }
                },
                o = function(e, t) {
                    e.css({
                        display: "block",
                        left: t.left,
                        top: t.top
                    })
                },
                i = 20;
            this.update = function(s, l, d) {
                t.update(s, l);
                var u = s.find(".note-link-popover");
                if (l.anchor) {
                    var c = u.find("a"),
                        f = e(l.anchor).attr("href");
                    c.attr("href", f).html(f), o(u, n(l.anchor, d))
                } else u.hide();
                var h = s.find(".note-image-popover");
                l.image ? o(h, n(l.image, d)) : h.hide();
                var p = s.find(".note-air-popover");
                if (d && !l.range.isCollapsed()) {
                    var v = r.rect2bnd(a.last(l.range.getClientRects()));
                    o(p, {
                        left: Math.max(v.left + v.width / 2 - i, 0),
                        top: v.top + v.height
                    })
                } else p.hide()
            }, this.updateRecentColor = function(e, t, n) {
                e.updateRecentColor(e, t, n)
            }, this.hide = function(e) {
                e.children().hide()
            }
        },
        T = function() {
            this.update = function(t, n, o) {
                var i = t.find(".note-control-selection");
                if (n.image) {
                    var r = e(n.image),
                        a = o ? r.offset() : r.position(),
                        s = {
                            w: r.outerWidth(!0),
                            h: r.outerHeight(!0)
                        };
                    i.css({
                        display: "block",
                        left: a.left,
                        top: a.top,
                        width: s.w,
                        height: s.h
                    }).data("target", n.image);
                    var l = s.w + "x" + s.h;
                    i.find(".note-control-selection-info").text(l)
                } else i.hide()
            }, this.hide = function(e) {
                e.children().hide()
            }
        },
        x = function() {
            var t = function(e, t) {
                e.toggleClass("disabled", !t), e.attr("disabled", !t)
            };
            this.showImageDialog = function(n, o) {
                return e.Deferred(function(e) {
                    var n = o.find(".note-image-dialog"),
                        i = o.find(".note-image-input"),
                        r = o.find(".note-image-url"),
                        a = o.find(".note-image-btn");
                    n.one("shown.bs.modal", function() {
                        i.replaceWith(i.clone().on("change", function() {
                            e.resolve(this.files), n.modal("hide")
                        }).val("")), a.click(function(t) {
                            t.preventDefault(), e.resolve(r.val()), n.modal("hide")
                        }), r.on("keyup paste", function(e) {
                            var n;
                            n = "paste" === e.type ? e.originalEvent.clipboardData.getData("text") : r.val(), t(a, n)
                        }).val("").trigger("focus")
                    }).one("hidden.bs.modal", function() {
                        i.off("change"), r.off("keyup paste"), a.off("click"), "pending" === e.state() && e.reject()
                    }).modal("show")
                })
            }, this.showLinkDialog = function(n, o, i) {
                return e.Deferred(function(e) {
                    var n = o.find(".note-link-dialog"),
                        r = n.find(".note-link-text"),
                        a = n.find(".note-link-url"),
                        s = n.find(".note-link-btn"),
                        l = n.find("input[type=checkbox]");
                    n.one("shown.bs.modal", function() {
                        r.val(i.text), r.keyup(function() {
                            i.text = r.val()
                        }), i.url || (i.url = i.text, t(s, i.text)), a.keyup(function() {
                            t(s, a.val()), i.text || r.val(a.val())
                        }).val(i.url).trigger("focus").trigger("select"), l.prop("checked", i.newWindow), s.one("click", function(t) {
                            t.preventDefault(), e.resolve({
                                range: i.range,
                                url: a.val(),
                                text: r.val(),
                                newWindow: l.is(":checked")
                            }), n.modal("hide")
                        })
                    }).one("hidden.bs.modal", function() {
                        r.off("keyup"), a.off("keyup"), s.off("click"), "pending" === e.state() && e.reject()
                    }).modal("show")
                }).promise()
            }, this.showHelpDialog = function(t, n) {
                return e.Deferred(function(e) {
                    var t = n.find(".note-help-dialog");
                    t.one("hidden.bs.modal", function() {
                        e.resolve()
                    }).modal("show")
                }).promise()
            }
        };
    i.hasCodeMirror && (i.isSupportAmd ? require(["CodeMirror"], function(e) {
        t = e
    }) : t = window.CodeMirror);
    var N = function() {
            var n = e(window),
                o = e(document),
                r = e("html, body"),
                s = new b,
                l = new w,
                u = new k,
                c = new T,
                p = new x;
            this.getEditor = function() {
                return s
            };
            var v = function(t) {
                    var n = e(t).closest(".note-editor, .note-air-editor, .note-air-layout");
                    if (!n.length) return null;
                    var o;
                    return o = n.is(".note-editor, .note-air-editor") ? n : e("#note-editor-" + a.last(n.attr("id").split("-"))), d.buildLayoutInfo(o)
                },
                g = function(t, n) {
                    var o = t.data("callbacks");
                    o.onImageUpload ? o.onImageUpload(n, s, t) : e.each(n, function(e, n) {
                        var i = n.name;
                        f.readFileAsDataURL(n).then(function(e) {
                            s.insertImage(t, e, i)
                        }).fail(function() {
                            o.onImageUploadError && o.onImageUploadError()
                        })
                    })
                },
                m = {
                    showLinkDialog: function(e) {
                        var t = e.editor(),
                            n = e.dialog(),
                            o = e.editable(),
                            i = s.getLinkInfo(o),
                            r = t.data("options");
                        s.saveRange(o), p.showLinkDialog(o, n, i).then(function(t) {
                            s.restoreRange(o), s.createLink(o, t, r), u.hide(e.popover())
                        }).fail(function() {
                            s.restoreRange(o)
                        })
                    },
                    showImageDialog: function(e) {
                        var t = e.dialog(),
                            n = e.editable();
                        s.saveRange(n), p.showImageDialog(n, t).then(function(e) {
                            s.restoreRange(n), "string" == typeof e ? s.insertImage(n, e) : g(n, e)
                        }).fail(function() {
                            s.restoreRange(n)
                        })
                    },
                    showHelpDialog: function(e) {
                        var t = e.dialog(),
                            n = e.editable();
                        s.saveRange(n, !0), p.showHelpDialog(n, t).then(function() {
                            s.restoreRange(n)
                        })
                    },
                    fullscreen: function(e) {
                        var t = e.editor(),
                            o = e.toolbar(),
                            i = e.editable(),
                            a = e.codable(),
                            s = t.data("options"),
                            d = function(e) {
                                t.css("width", e.w), i.css("height", e.h), a.css("height", e.h), a.data("cmeditor") && a.data("cmeditor").setsize(null, e.h)
                            };
                        t.toggleClass("fullscreen");
                        var u = t.hasClass("fullscreen");
                        u ? (i.data("orgheight", i.css("height")), n.on("resize", function() {
                            d({
                                w: n.width(),
                                h: n.height() - o.outerHeight()
                            })
                        }).trigger("resize"), r.css("overflow", "hidden")) : (n.off("resize"), d({
                            w: s.width || "",
                            h: i.data("orgheight")
                        }), r.css("overflow", "visible")), l.updateFullscreen(o, u)
                    },
                    codeview: function(e) {
                        var n, o, r = e.editor(),
                            a = e.toolbar(),
                            s = e.editable(),
                            c = e.codable(),
                            f = e.popover(),
                            h = r.data("options");
                        r.toggleClass("codeview");
                        var p = r.hasClass("codeview");
                        p ? (c.val(d.html(s, !0)), c.height(s.height()), l.deactivate(a), u.hide(f), c.focus(), i.hasCodeMirror && (n = t.fromTextArea(c[0], h.codemirror), h.codemirror.tern && (o = new t.TernServer(h.codemirror.tern), n.ternServer = o, n.on("cursorActivity", function(e) {
                            o.updateArgHints(e)
                        })), n.setSize(null, s.outerHeight()), c.data("cmEditor", n))) : (i.hasCodeMirror && (n = c.data("cmEditor"), c.val(n.getValue()), n.toTextArea()), s.html(d.value(c) || d.emptyPara), s.height(h.height ? c.height() : "auto"), l.activate(a), s.focus()), l.updateCodeview(e.toolbar(), p)
                    }
                },
                y = function(e) {
                    d.isImg(e.target) && e.preventDefault()
                },
                N = function(e) {
                    setTimeout(function() {
                        var t = v(e.currentTarget || e.target),
                            n = s.currentStyle(e.target);
                        if (n) {
                            var o = t.editor().data("options").airMode;
                            o || l.update(t.toolbar(), n), u.update(t.popover(), n, o), c.update(t.handle(), n, o)
                        }
                    }, 0)
                },
                S = function(e) {
                    var t = v(e.currentTarget || e.target);
                    u.hide(t.popover()), c.hide(t.handle())
                },
                L = function(e) {
                    var t = e.originalEvent.clipboardData;
                    if (t && t.items && t.items.length) {
                        var n = v(e.currentTarget || e.target),
                            o = n.editable(),
                            i = a.head(t.items),
                            r = "file" === i.kind && -1 !== i.type.indexOf("image/");
                        r && g(o, [i.getAsFile()]), s.afterCommand(o)
                    }
                },
                F = function(t) {
                    if (d.isControlSizing(t.target)) {
                        t.preventDefault(), t.stopPropagation();
                        var n = v(t.target),
                            i = n.handle(),
                            r = n.popover(),
                            a = n.editable(),
                            l = n.editor(),
                            f = i.find(".note-control-selection").data("target"),
                            h = e(f),
                            p = h.offset(),
                            g = o.scrollTop(),
                            m = l.data("options").airMode;
                        o.on("mousemove", function(e) {
                            s.resizeTo({
                                x: e.clientX - p.left,
                                y: e.clientY - (p.top - g)
                            }, h, !e.shiftKey), c.update(i, {
                                image: f
                            }, m), u.update(r, {
                                image: f
                            }, m)
                        }).one("mouseup", function() {
                            o.off("mousemove")
                        }), h.data("ratio") || h.data("ratio", h.height() / h.width()), s.afterCommand(a)
                    }
                },
                E = function(t) {
                    var n = e(t.target).closest("[data-event]");
                    n.length && t.preventDefault()
                },
                M = function(t) {
                    var n = e(t.target).closest("[data-event]");
                    if (n.length) {
                        var o = n.attr("data-event"),
                            i = n.attr("data-value"),
                            r = n.attr("data-hide"),
                            d = v(t.target);
                        t.preventDefault();
                        var c;
                        if (-1 !== e.inArray(o, ["resize", "floatMe", "removeMedia", "imageShape"])) {
                            var f = d.handle().find(".note-control-selection");
                            c = e(f.data("target"))
                        }
                        if (r && n.parents(".popover").hide(), s[o]) {
                            var h = d.editable();
                            h.trigger("focus"), s[o](h, i, c)
                        } else m[o] ? m[o].call(this, d) : e.isFunction(e.summernote.pluginEvents[o]) && e.summernote.pluginEvents[o](d, i, c);
                        if (-1 !== e.inArray(o, ["backColor", "foreColor"])) {
                            var p = d.editor().data("options", p),
                                g = p.airMode ? u : l;
                            g.updateRecentColor(a.head(n), o, i)
                        }
                        N(t)
                    }
                },
                R = 24,
                I = function(e) {
                    e.preventDefault(), e.stopPropagation();
                    var t = v(e.target).editable(),
                        n = t.offset().top - o.scrollTop(),
                        i = v(e.currentTarget || e.target),
                        r = i.editor().data("options");
                    o.on("mousemove", function(e) {
                        var o = e.clientY - (n + R);
                        o = r.minHeight > 0 ? Math.max(o, r.minHeight) : o, o = r.maxHeight > 0 ? Math.min(o, r.maxHeight) : o, t.height(o)
                    }).one("mouseup", function() {
                        o.off("mousemove")
                    })
                },
                A = 18,
                P = function(t, n) {
                    var o, i = e(t.target.parentNode),
                        r = i.next(),
                        a = i.find(".note-dimension-picker-mousecatcher"),
                        s = i.find(".note-dimension-picker-highlighted"),
                        l = i.find(".note-dimension-picker-unhighlighted");
                    if (void 0 === t.offsetX) {
                        var d = e(t.target).offset();
                        o = {
                            x: t.pageX - d.left,
                            y: t.pageY - d.top
                        }
                    } else o = {
                        x: t.offsetX,
                        y: t.offsetY
                    };
                    var u = {
                        c: Math.ceil(o.x / A) || 1,
                        r: Math.ceil(o.y / A) || 1
                    };
                    s.css({
                        width: u.c + "em",
                        height: u.r + "em"
                    }), a.attr("data-value", u.c + "x" + u.r), 3 < u.c && u.c < n.insertTableMaxSize.col && l.css({
                        width: u.c + 1 + "em"
                    }), 3 < u.r && u.r < n.insertTableMaxSize.row && l.css({
                        height: u.r + 1 + "em"
                    }), r.html(u.c + " x " + u.r)
                },
                H = function(e, t) {
                    t ? o.on("drop", function(e) {
                        e.preventDefault()
                    }) : D(e)
                },
                D = function(t) {
                    var n = e(),
                        i = t.dropzone,
                        r = t.dropzone.find(".note-dropzone-message");
                    o.on("dragenter", function(e) {
                        var o = t.editor.hasClass("codeview");
                        o || n.length || (t.editor.addClass("dragover"), i.width(t.editor.width()), i.height(t.editor.height()), r.text(t.langInfo.image.dragImageHere)), n = n.add(e.target)
                    }).on("dragleave", function(e) {
                        n = n.not(e.target), n.length || t.editor.removeClass("dragover")
                    }).on("drop", function() {
                        n = e(), t.editor.removeClass("dragover")
                    }), i.on("dragenter", function() {
                        i.addClass("hover"), r.text(t.langInfo.image.dropImage)
                    }).on("dragleave", function() {
                        i.removeClass("hover"), r.text(t.langInfo.image.dragImageHere)
                    }), i.on("drop", function(e) {
                        e.preventDefault();
                        var t = e.originalEvent.dataTransfer;
                        if (t && t.files) {
                            var n = v(e.currentTarget || e.target);
                            n.editable().focus(), g(n.editable(), t.files)
                        }
                    }).on("dragover", !1)
                };
            this.bindKeyMap = function(t, n) {
                var o = t.editor,
                    i = t.editable;
                t = v(i), i.on("keydown", function(r) {
                    var a = [];
                    r.metaKey && a.push("CMD"), r.ctrlKey && !r.altKey && a.push("CTRL"), r.shiftKey && a.push("SHIFT");
                    var l = h.nameFromCode[r.keyCode];
                    l && a.push(l);
                    var d = n[a.join("+")];
                    if (d) {
                        if (r.preventDefault(), s[d]) s[d](i, o.data("options"));
                        else if (m[d]) m[d].call(this, t);
                        else if (e.summernote.plugins[d]) {
                            var u = e.summernote.plugins[d];
                            e.isFunction(u.event) && u.event(r, s, t)
                        }
                    } else h.isEdit(r.keyCode) && s.afterCommand(i)
                })
            }, this.attach = function(e, t) {
                t.shortcuts && this.bindKeyMap(e, t.keyMap[i.isMac ? "mac" : "pc"]), e.editable.on("mousedown", y), e.editable.on("keyup mouseup", N), e.editable.on("scroll", S), e.editable.on("paste", L), e.handle.on("mousedown", F), e.popover.on("click", M), e.popover.on("mousedown", E), t.airMode || (H(e, t.disableDragAndDrop), e.toolbar.on("click", M), e.toolbar.on("mousedown", E), t.disableResizeEditor || e.statusbar.on("mousedown", I));
                var n = t.airMode ? e.popover : e.toolbar,
                    o = n.find(".note-dimension-picker-mousecatcher");
                o.css({
                    width: t.insertTableMaxSize.col + "em",
                    height: t.insertTableMaxSize.row + "em"
                }).on("mousemove", function(e) {
                    P(e, t)
                }), e.editor.data("options", t), t.styleWithSpan && !i.isMSIE && setTimeout(function() {
                    document.execCommand("styleWithCSS", 0, !0)
                }, 0);
                var r = new C(e.editable);
                if (e.editable.data("NoteHistory", r), t.onenter && e.editable.keypress(function(e) {
                        e.keyCode === h.ENTER && t.onenter(e)
                    }), t.onfocus && e.editable.focus(t.onfocus), t.onblur && e.editable.blur(t.onblur), t.onkeyup && e.editable.keyup(t.onkeyup), t.onkeydown && e.editable.keydown(t.onkeydown), t.onpaste && e.editable.on("paste", t.onpaste), t.onToolbarClick && e.toolbar.click(t.onToolbarClick), t.onChange) {
                    var a = function() {
                        s.triggerOnChange(e.editable)
                    };
                    if (i.isMSIE) {
                        var l = "DOMCharacterDataModified DOMSubtreeModified DOMNodeInserted";
                        e.editable.on(l, a)
                    } else e.editable.on("input", a)
                }
                e.editable.data("callbacks", {
                    onChange: t.onChange,
                    onAutoSave: t.onAutoSave,
                    onImageUpload: t.onImageUpload,
                    onImageUploadError: t.onImageUploadError,
                    onFileUpload: t.onFileUpload,
                    onFileUploadError: t.onFileUpload
                })
            }, this.detach = function(e, t) {
                e.editable.off(), e.popover.off(), e.handle.off(), e.dialog.off(), t.airMode || (e.dropzone.off(), e.toolbar.off(), e.statusbar.off())
            }
        },
        S = function() {
            var t = function(e, t) {
                    var n = t.event,
                        o = t.value,
                        i = t.title,
                        r = t.className,
                        a = t.dropdown,
                        s = t.hide;
                    return '<button type="button" class="btn btn-default btn-sm btn-small' + (r ? " " + r : "") + (a ? " dropdown-toggle" : "") + '"' + (a ? ' data-toggle="dropdown"' : "") + (i ? ' title="' + i + '"' : "") + (n ? ' data-event="' + n + '"' : "") + (o ? " data-value='" + o + "'" : "") + (s ? " data-hide='" + s + "'" : "") + ' tabindex="-1">' + e + (a ? ' <span class="caret"></span>' : "") + "</button>" + (a || "")
                },
                n = function(e, n) {
                    var o = '<i class="' + e + '"></i>';
                    return t(o, n)
                },
                o = function(e, t) {
                    return '<div class="' + e + ' popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content">' + t + "</div></div>"
                },
                a = function(e, t, n, o) {
                    return '<div class="' + e + ' modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content">' + (t ? '<div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">&times;</button><h4 class="modal-title">' + t + "</h4></div>" : "") + '<form class="note-modal-form"><div class="modal-body">' + n + "</div>" + (o ? '<div class="modal-footer">' + o + "</div>" : "") + "</form></div></div></div>"
                },
                s = {
                    picture: function(e) {
                        return n("fa fa-picture-o", {
                            event: "showImageDialog",
                            title: e.image.image,
                            hide: !0
                        })
                    },
                    link: function(e) {
                        return n("fa fa-link", {
                            event: "showLinkDialog",
                            title: e.link.link,
                            hide: !0
                        })
                    },
                    table: function(e) {
                        var t = '<ul class="note-table dropdown-menu"><div class="note-dimension-picker"><div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1"></div><div class="note-dimension-picker-highlighted"></div><div class="note-dimension-picker-unhighlighted"></div></div><div class="note-dimension-display"> 1 x 1 </div></ul>';
                        return n("fa fa-table", {
                            title: e.table.table,
                            dropdown: t
                        })
                    },
                    style: function(e, t) {
                        var o = t.styleTags.reduce(function(t, n) {
                            var o = e.style["p" === n ? "normal" : n];
                            return t + '<li><a data-event="formatBlock" href="#" data-value="' + n + '">' + ("p" === n || "pre" === n ? o : "<" + n + ">" + o + "</" + n + ">") + "</a></li>"
                        }, "");
                        return n("fa fa-magic", {
                            title: e.style.style,
                            dropdown: '<ul class="dropdown-menu">' + o + "</ul>"
                        })
                    },
                    fontname: function(e, n) {
                        var o = n.fontNames.reduce(function(e, t) {
                                return i.isFontInstalled(t) ? e + '<li><a data-event="fontName" href="#" data-value="' + t + '"><i class="fa fa-check"></i> ' + t + "</a></li>" : e
                            }, ""),
                            r = '<span class="note-current-fontname">' + n.defaultFontName + "</span>";
                        return t(r, {
                            title: e.font.name,
                            dropdown: '<ul class="dropdown-menu">' + o + "</ul>"
                        })
                    },
                    color: function(e) {
                        var n = '<i class="fa fa-font" style="color:black;background-color:yellow;"></i>',
                            o = t(n, {
                                className: "note-recent-color",
                                title: e.color.recent,
                                event: "color",
                                value: '{"backColor":"yellow"}'
                            }),
                            i = '<ul class="dropdown-menu"><li><div class="btn-group"><div class="note-palette-title">' + e.color.background + '</div><div class="note-color-reset" data-event="backColor" data-value="inherit" title="' + e.color.transparent + '">' + e.color.setTransparent + '</div><div class="note-color-palette" data-target-event="backColor"></div></div><div class="btn-group"><div class="note-palette-title">' + e.color.foreground + '</div><div class="note-color-reset" data-event="foreColor" data-value="inherit" title="' + e.color.reset + '">' + e.color.resetToDefault + '</div><div class="note-color-palette" data-target-event="foreColor"></div></div></li></ul>',
                            r = t("", {
                                title: e.color.more,
                                dropdown: i
                            });
                        return o + r
                    },
                    bold: function(e) {
                        return n("fa fa-bold", {
                            event: "bold",
                            title: e.font.bold
                        })
                    },
                    italic: function(e) {
                        return n("fa fa-italic", {
                            event: "italic",
                            title: e.font.italic
                        })
                    },
                    underline: function(e) {
                        return n("fa fa-underline", {
                            event: "underline",
                            title: e.font.underline
                        })
                    },
                    clear: function(e) {
                        return n("fa fa-eraser", {
                            event: "removeFormat",
                            title: e.font.clear
                        })
                    },
                    ul: function(e) {
                        return n("fa fa-list-ul", {
                            event: "insertUnorderedList",
                            title: e.lists.unordered
                        })
                    },
                    ol: function(e) {
                        return n("fa fa-list-ol", {
                            event: "insertOrderedList",
                            title: e.lists.ordered
                        })
                    },
                    paragraph: function(e) {
                        var t = n("fa fa-align-left", {
                                title: e.paragraph.left,
                                event: "justifyLeft"
                            }),
                            o = n("fa fa-align-center", {
                                title: e.paragraph.center,
                                event: "justifyCenter"
                            }),
                            i = n("fa fa-align-right", {
                                title: e.paragraph.right,
                                event: "justifyRight"
                            }),
                            r = n("fa fa-align-justify", {
                                title: e.paragraph.justify,
                                event: "justifyFull"
                            }),
                            a = n("fa fa-outdent", {
                                title: e.paragraph.outdent,
                                event: "outdent"
                            }),
                            s = n("fa fa-indent", {
                                title: e.paragraph.indent,
                                event: "indent"
                            }),
                            l = '<div class="dropdown-menu"><div class="note-align btn-group">' + t + o + i + r + '</div><div class="note-list btn-group">' + s + a + "</div></div>";
                        return n("fa fa-align-left", {
                            title: e.paragraph.paragraph,
                            dropdown: l
                        })
                    },
                    height: function(e, t) {
                        var o = t.lineHeights.reduce(function(e, t) {
                            return e + '<li><a data-event="lineHeight" href="#" data-value="' + parseFloat(t) + '"><i class="fa fa-check"></i> ' + t + "</a></li>"
                        }, "");
                        return n("fa fa-text-height", {
                            title: e.font.height,
                            dropdown: '<ul class="dropdown-menu">' + o + "</ul>"
                        })
                    },
                    help: function(e) {
                        return n("fa fa-question", {
                            event: "showHelpDialog",
                            title: e.options.help,
                            hide: !0
                        })
                    },
                    fullscreen: function(e) {
                        return n("fa fa-arrows-alt", {
                            event: "fullscreen",
                            title: e.options.fullscreen
                        })
                    },
                    codeview: function(e) {
                        return n("fa fa-code", {
                            event: "codeview",
                            title: e.options.codeview
                        })
                    },
                    undo: function(e) {
                        return n("fa fa-undo", {
                            event: "undo",
                            title: e.history.undo
                        })
                    },
                    redo: function(e) {
                        return n("fa fa-repeat", {
                            event: "redo",
                            title: e.history.redo
                        })
                    },
                    hr: function(e) {
                        return n("fa fa-minus", {
                            event: "insertHorizontalRule",
                            title: e.hr.insert
                        })
                    }
                },
                l = function(e, i) {
                    var r = function() {
                            var t = n("fa fa-edit", {
                                    title: e.link.edit,
                                    event: "showLinkDialog",
                                    hide: !0
                                }),
                                i = n("fa fa-unlink", {
                                    title: e.link.unlink,
                                    event: "unlink"
                                }),
                                r = '<a href="http://www.google.com" target="_blank">www.google.com</a>&nbsp;&nbsp;<div class="note-insert btn-group">' + t + i + "</div>";
                            return o("note-link-popover", r)
                        },
                        a = function() {
                            var i = t('<span class="note-fontsize-10">100%</span>', {
                                    title: e.image.resizeFull,
                                    event: "resize",
                                    value: "1"
                                }),
                                r = t('<span class="note-fontsize-10">50%</span>', {
                                    title: e.image.resizeHalf,
                                    event: "resize",
                                    value: "0.5"
                                }),
                                a = t('<span class="note-fontsize-10">25%</span>', {
                                    title: e.image.resizeQuarter,
                                    event: "resize",
                                    value: "0.25"
                                }),
                                s = n("fa fa-align-left", {
                                    title: e.image.floatLeft,
                                    event: "floatMe",
                                    value: "left"
                                }),
                                l = n("fa fa-align-right", {
                                    title: e.image.floatRight,
                                    event: "floatMe",
                                    value: "right"
                                }),
                                d = n("fa fa-align-justify", {
                                    title: e.image.floatNone,
                                    event: "floatMe",
                                    value: "none"
                                }),
                                u = n("fa fa-square", {
                                    title: e.image.shapeRounded,
                                    event: "imageShape",
                                    value: "img-rounded"
                                }),
                                c = n("fa fa-circle-o", {
                                    title: e.image.shapeCircle,
                                    event: "imageShape",
                                    value: "img-circle"
                                }),
                                f = n("fa fa-picture-o", {
                                    title: e.image.shapeThumbnail,
                                    event: "imageShape",
                                    value: "img-thumbnail"
                                }),
                                h = n("fa fa-times", {
                                    title: e.image.shapeNone,
                                    event: "imageShape",
                                    value: ""
                                }),
                                p = n("fa fa-trash-o", {
                                    title: e.image.remove,
                                    event: "removeMedia",
                                    value: "none"
                                }),
                                v = '<div class="btn-group">' + i + r + a + '</div><div class="btn-group">' + s + l + d + '</div><div class="btn-group">' + u + c + f + h + '</div><div class="btn-group">' + p + "</div>";
                            return o("note-image-popover", v)
                        },
                        l = function() {
                            for (var t = "", n = 0, r = i.airPopover.length; r > n; n++) {
                                var a = i.airPopover[n];
                                t += '<div class="note-' + a[0] + ' btn-group">';
                                for (var l = 0, d = a[1].length; d > l; l++) t += s[a[1][l]](e, i);
                                t += "</div>"
                            }
                            return o("note-air-popover", t)
                        };
                    return '<div class="note-popover">' + r() + a() + (i.airMode ? l() : "") + "</div>"
                },
                u = function() {
                    return '<div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div>'
                },
                c = function(e, t) {
                    var n = "note-shortcut-col col-xs-6 note-shortcut-",
                        o = [];
                    for (var i in t) o.push('<div class="' + n + 'key">' + t[i].kbd + '</div><div class="' + n + 'name">' + t[i].text + "</div>");
                    return '<div class="note-shortcut-row row"><div class="' + n + 'title col-xs-offset-6">' + e + '</div></div><div class="note-shortcut-row row">' + o.join('</div><div class="note-shortcut-row row">') + "</div>"
                },
                f = function(e) {
                    var t = [{
                        kbd: "⌘ + B",
                        text: e.font.bold
                    }, {
                        kbd: "⌘ + I",
                        text: e.font.italic
                    }, {
                        kbd: "⌘ + U",
                        text: e.font.underline
                    }, {
                        kbd: "⌘ + ⇧ + S",
                        text: e.font.sdivikethrough
                    }, {
                        kbd: "⌘ + \\",
                        text: e.font.clear
                    }];
                    return c(e.shortcut.textFormatting, t)
                },
                h = function(e) {
                    var t = [{
                        kbd: "⌘ + Z",
                        text: e.history.undo
                    }, {
                        kbd: "⌘ + ⇧ + Z",
                        text: e.history.redo
                    }, {
                        kbd: "⌘ + ]",
                        text: e.paragraph.indent
                    }, {
                        kbd: "⌘ + [",
                        text: e.paragraph.oudivent
                    }, {
                        kbd: "⌘ + ENTER",
                        text: e.hr.insert
                    }];
                    return c(e.shortcut.action, t)
                },
                p = function(e) {
                    var t = [{
                        kbd: "⌘ + ⇧ + L",
                        text: e.paragraph.left
                    }, {
                        kbd: "⌘ + ⇧ + E",
                        text: e.paragraph.center
                    }, {
                        kbd: "⌘ + ⇧ + R",
                        text: e.paragraph.right
                    }, {
                        kbd: "⌘ + ⇧ + J",
                        text: e.paragraph.justify
                    }, {
                        kbd: "⌘ + ⇧ + NUM7",
                        text: e.lists.ordered
                    }, {
                        kbd: "⌘ + ⇧ + NUM8",
                        text: e.lists.unordered
                    }];
                    return c(e.shortcut.paragraphFormatting, t)
                },
                v = function(e) {
                    var t = [{
                        kbd: "⌘ + NUM0",
                        text: e.style.normal
                    }, {
                        kbd: "⌘ + NUM1",
                        text: e.style.h1
                    }, {
                        kbd: "⌘ + NUM2",
                        text: e.style.h2
                    }, {
                        kbd: "⌘ + NUM3",
                        text: e.style.h3
                    }, {
                        kbd: "⌘ + NUM4",
                        text: e.style.h4
                    }, {
                        kbd: "⌘ + NUM5",
                        text: e.style.h5
                    }, {
                        kbd: "⌘ + NUM6",
                        text: e.style.h6
                    }];
                    return c(e.shortcut.documentStyle, t)
                },
                g = function(e, t) {
                    var n = t.extraKeys,
                        o = [];
                    for (var i in n) n.hasOwnProperty(i) && o.push({
                        kbd: i,
                        text: n[i]
                    });
                    return c(e.shortcut.extraKeys, o)
                },
                m = function(e, t) {
                    var n = 'class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"',
                        o = ["<div " + n + ">" + h(e, t) + "</div><div " + n + ">" + f(e, t) + "</div>", "<div " + n + ">" + v(e, t) + "</div><div " + n + ">" + p(e, t) + "</div>"];
                    return t.extraKeys && o.push("<div " + n + ">" + g(e, t) + "</div>"), '<div class="note-shortcut-row row">' + o.join('</div><div class="note-shortcut-row row">') + "</div>"
                },
                b = function(e) {
                    return e.replace(/⌘/g, "Ctrl").replace(/⇧/g, "Shift")
                },
                C = {
                    image: function(e) {
                        var t = '<div class="form-group row-fluid note-group-select-from-files"><label>' + e.image.selectFromFiles + '</label><input class="note-image-input" type="file" name="files" accept="image/*" /></div><div class="form-group row-fluid"><label>' + e.image.url + '</label><input class="note-image-url form-control span12" type="text" /></div>',
                            n = '<button href="#" class="btn btn-primary note-image-btn disabled" disabled>' + e.image.insert + "</button>";
                        return a("note-image-dialog", e.image.insert, t, n)
                    },
                    link: function(e, t) {
                        var n = '<div class="form-group row-fluid"><label>' + e.link.textToDisplay + '</label><input class="note-link-text form-control span12" type="text" /></div><div class="form-group row-fluid"><label>' + e.link.url + '</label><input class="note-link-url form-control span12" type="text" /></div>' + (t.disableLinkTarget ? "" : '<div class="checkbox"><label><input type="checkbox" checked> ' + e.link.openInNewWindow + "</label></div>"),
                            o = '<button href="#" class="btn btn-primary note-link-btn disabled" disabled>' + e.link.insert + "</button>";
                        return a("note-link-dialog", e.link.insert, n, o)
                    },
                    help: function(e, t) {
                        var n = '<a class="modal-close pull-right" aria-hidden="true" tabindex="-1">' + e.shortcut.close + '</a><div class="title">' + e.shortcut.shortcuts + "</div>" + (i.isMac ? m(e, t) : b(m(e, t))) + '<p class="text-center"><a href="//hackerwins.github.io/summernote/" target="_blank">Summernote 0.5.10</a> · <a href="//github.com/HackerWins/summernote" target="_blank">Project</a> · <a href="//github.com/HackerWins/summernote/issues" target="_blank">Issues</a></p>';
                        return a("note-help-dialog", "", n, "")
                    }
                },
                y = function(t, n) {
                    var o = "";
                    return e.each(C, function(e, i) {
                        o += i(t, n)
                    }), '<div class="note-dialog">' + o + "</div>"
                },
                w = function() {
                    return '<div class="note-resizebar"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div>'
                },
                k = function(e) {
                    return i.isMac && (e = e.replace("CMD", "⌘").replace("SHIFT", "⇧")), e.replace("BACKSLASH", "\\").replace("SLASH", "/").replace("LEFTBRACKET", "[").replace("RIGHTBRACKET", "]")
                },
                T = function(t, n, o) {
                    var i = r.invertObject(n),
                        a = t.find("button");
                    a.each(function(t, n) {
                        var o = e(n),
                            r = i[o.data("event")];
                        r && o.attr("title", function(e, t) {
                            return t + " (" + k(r) + ")"
                        })
                    }).tooltip({
                        container: "body",
                        trigger: "hover",
                        placement: o || "top"
                    }).on("click", function() {
                        e(this).tooltip("hide")
                    })
                },
                x = function(t, n) {
                    var o = n.colors;
                    t.find(".note-color-palette").each(function() {
                        for (var t = e(this), n = t.attr("data-target-event"), i = [], r = 0, a = o.length; a > r; r++) {
                            for (var s = o[r], l = [], d = 0, u = s.length; u > d; d++) {
                                var c = s[d];
                                l.push(['<button type="button" class="note-color-btn" style="background-color:', c, ';" data-event="', n, '" data-value="', c, '" title="', c, '" data-toggle="button" tabindex="-1"></button>'].join(""))
                            }
                            i.push('<div class="note-color-row">' + l.join("") + "</div>")
                        }
                        t.html(i.join(""))
                    })
                };
            this.createLayoutByAirMode = function(t, n, o) {
                var a = n.keyMap[i.isMac ? "mac" : "pc"],
                    s = r.uniqueId();
                t.addClass("note-air-editor note-editable"), t.attr({
                    id: "note-editor-" + s,
                    contentEditable: !0
                });
                var d = document.body,
                    c = e(l(o, n));
                c.addClass("note-air-layout"), c.attr("id", "note-popover-" + s), c.appendTo(d), T(c, a), x(c, n);
                var f = e(u());
                f.addClass("note-air-layout"), f.attr("id", "note-handle-" + s), f.appendTo(d);
                var h = e(y(o, n));
                h.addClass("note-air-layout"), h.attr("id", "note-dialog-" + s), h.find("button.close, a.modal-close").click(function() {
                    e(this).closest(".modal").modal("hide")
                }), h.appendTo(d)
            }, this.createLayoutByFrame = function(t, n, o) {
                var r = e('<div class="note-editor"></div>');
                n.width && r.width(n.width), n.height > 0 && e('<div class="note-statusbar">' + (n.disableResizeEditor ? "" : w()) + "</div>").prependTo(r);
                var a = !t.is(":disabled"),
                    c = e('<div class="note-editable" contentEditable="' + a + '"></div>').prependTo(r);
                n.height && c.height(n.height), n.direction && c.attr("dir", n.direction), c.html(d.html(t) || d.emptyPara), e('<textarea class="note-codable"></textarea>').prependTo(r);
                for (var f = "", h = 0, p = n.toolbar.length; p > h; h++) {
                    var v = n.toolbar[h][0],
                        g = n.toolbar[h][1];
                    f += '<div class="note-' + v + ' btn-group">';
                    for (var m = 0, b = g.length; b > m; m++) {
                        var C = s[g[m]];
                        e.isFunction(C) && (f += C(o, n))
                    }
                    f += "</div>"
                }
                f = '<div class="note-toolbar btn-toolbar">' + f + "</div>";
                var k = e(f).prependTo(r),
                    N = n.keyMap[i.isMac ? "mac" : "pc"];
                x(k, n), T(k, N, "bottom");
                var S = e(l(o, n)).prependTo(r);
                x(S, n), T(S, N), e(u()).prependTo(r);
                var L = e(y(o, n)).prependTo(r);
                L.find("button.close, a.modal-close").click(function() {
                    e(this).closest(".modal").modal("hide")
                }), e('<div class="note-dropzone"><div class="note-dropzone-message"></div></div>').prependTo(r), r.insertAfter(t), t.hide()
            }, this.noteEditorFromHolder = function(t) {
                return t.hasClass("note-air-editor") ? t : t.next().hasClass("note-editor") ? t.next() : e()
            }, this.createLayout = function(e, t, n) {
                this.noteEditorFromHolder(e).length || (t.airMode ? this.createLayoutByAirMode(e, t, n) : this.createLayoutByFrame(e, t, n))
            }, this.layoutInfoFromHolder = function(e) {
                var t = this.noteEditorFromHolder(e);
                if (t.length) {
                    var n = d.buildLayoutInfo(t);
                    for (var o in n) n.hasOwnProperty(o) && (n[o] = n[o].call());
                    return n
                }
            }, this.removeLayout = function(e, t, n) {
                n.airMode ? (e.removeClass("note-air-editor note-editable").removeAttr("id contentEditable"), t.popover.remove(), t.handle.remove(), t.dialog.remove()) : (e.html(t.editable.html()), t.editor.remove(), e.show())
            }, this.getTemplate = function() {
                return {
                    button: t,
                    iconButton: n,
                    dialog: a
                }
            }, this.addButtonInfo = function(e, t) {
                s[e] = t
            }, this.addDialogInfo = function(e, t) {
                C[e] = t
            }
        };
    e.summernote = e.summernote || {}, e.extend(e.summernote, c);
    var L = new S,
        F = new N;
    e.extend(e.summernote, {
        renderer: L,
        eventHandler: F,
        core: {
            agent: i,
            dom: d,
            range: u
        },
        pluginEvents: {}
    }), e.summernote.addPlugin = function(t) {
        t.buttons && e.each(t.buttons, function(e, t) {
            L.addButtonInfo(e, t)
        }), t.dialogs && e.each(t.dialogs, function(e, t) {
            L.addDialogInfo(e, t)
        }), t.events && e.each(t.events, function(t, n) {
            e.summernote.pluginEvents[t] = n
        }), t.langs && e.each(t.langs, function(t, n) {
            e.summernote.lang[t] && e.extend(e.summernote.lang[t], n)
        }), t.options && e.extend(e.summernote.options, t.options)
    }, e.fn.extend({
        summernote: function(t) {
            if (t = e.extend({}, e.summernote.options, t), this.each(function(n, o) {
                    var i = e(o),
                        r = e.extend(!0, {}, e.summernote.lang["en-US"], e.summernote.lang[t.lang]);
                    L.createLayout(i, t, r);
                    var a = L.layoutInfoFromHolder(i);
                    a.langInfo = r, F.attach(a, t), d.isTextarea(i[0]) && i.closest("form").submit(function() {
                        var e = i.code();
                        i.val(e), t.onsubmit && t.onsubmit(e)
                    })
                }), this.first().length && t.focus) {
                var n = L.layoutInfoFromHolder(this.first());
                n.editable.focus()
            }
            return this.length && t.oninit && t.oninit(), this
        },
        code: function(t) {
            if (void 0 === t) {
                var n = this.first();
                if (!n.length) return;
                var o = L.layoutInfoFromHolder(n);
                if (o && o.editable) {
                    var r = o.editor.hasClass("codeview");
                    return r && i.hasCodeMirror && o.codable.data("cmEditor").save(), r ? o.codable.val() : o.editable.html()
                }
                return d.isTextarea(n[0]) ? n.val() : n.html()
            }
            return this.each(function(n, o) {
                var i = L.layoutInfoFromHolder(e(o));
                i && i.editable && i.editable.html(t)
            }), this
        },
        destroy: function() {
            return this.each(function(t, n) {
                var o = e(n),
                    i = L.layoutInfoFromHolder(o);
                if (i && i.editable) {
                    var r = i.editor.data("options");
                    F.detach(i, r), L.removeLayout(o, i, r)
                }
            }), this
        }
    })
});