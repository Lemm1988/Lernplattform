/**
 * WiSo-Trainer: Wirtschafts- und Sozialkunde üben – Fallentscheidungen, Zahlen und Fristen,
 * Kündigungsfristen (§ 622 BGB), Urlaubsanspruch und Sozialversicherungsbeiträge.
 * Rechtsstand der Inhalte: 2026. Beitragssätze werden in den Aufgaben immer mit angegeben.
 */
(function () {
    'use strict';

    const { h, checkFields, numberInput, deFormat, dePlain, mark, deck } = window.ITGame;
    const eur = (n) => deFormat(n, 2) + ' €';
    const r2 = (n) => Math.round(n * 100) / 100;

    // ---------- Datumshelfer (UTC, damit Sommerzeit nicht stört) ----------

    const datum = (y, m, d) => new Date(Date.UTC(y, m - 1, d));
    const plusTage = (dt, n) => new Date(dt.getTime() + n * 86400000);
    const tageImMonat = (y, m) => new Date(Date.UTC(y, m, 0)).getUTCDate();
    const monatsende = (dt) => datum(dt.getUTCFullYear(), dt.getUTCMonth() + 1, tageImMonat(dt.getUTCFullYear(), dt.getUTCMonth() + 1));
    function plusMonate(dt, n) {
        const y = dt.getUTCFullYear();
        const m = dt.getUTCMonth() + 1 + n;
        const zy = y + Math.floor((m - 1) / 12);
        const zm = (((m - 1) % 12) + 12) % 12 + 1;       // auch für negative n (rückwärts rechnen)
        return datum(zy, zm, Math.min(dt.getUTCDate(), tageImMonat(zy, zm)));
    }
    const iso = (dt) => dt.toISOString().slice(0, 10);
    const de = (dt) => `${String(dt.getUTCDate()).padStart(2, '0')}.${String(dt.getUTCMonth() + 1).padStart(2, '0')}.${dt.getUTCFullYear()}`;
    const WOCHENTAG = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
    const deLang = (dt) => WOCHENTAG[dt.getUTCDay()] + ', ' + de(dt);
    const zufallsDatum = (rng, von, bis) => datum(rng.int(von, bis), rng.int(1, 12), 1 + rng.int(0, 27));
    const volleJahre = (von, bis) => {
        let j = bis.getUTCFullYear() - von.getUTCFullYear();
        if (bis.getUTCMonth() < von.getUTCMonth() || (bis.getUTCMonth() === von.getUTCMonth() && bis.getUTCDate() < von.getUTCDate())) j--;
        return j;
    };

    // ---------- Fallentscheidungen ----------

    const FAELLE = [
        { t: 'Ausbildung', f: 'Lena ist seit sechs Wochen in der Ausbildung (Probezeit vier Monate). Sie merkt, dass der Beruf nicht zu ihr passt, und möchte sofort aufhören.', o: ['Sie kann jederzeit ohne Kündigungsfrist schriftlich kündigen.', 'Sie muss vier Wochen Kündigungsfrist einhalten.', 'Sie braucht einen wichtigen Grund.', 'Sie kann erst nach der Probezeit kündigen.'], r: 0, e: 'In der Probezeit können beide Seiten das Ausbildungsverhältnis jederzeit ohne Frist kündigen (§ 22 Abs. 1 BBiG) – aber schriftlich.' },
        { t: 'Ausbildung', f: 'Nach der Probezeit möchte ein Ausbildungsbetrieb einem Azubi ordentlich mit vier Wochen Frist kündigen, weil die Auftragslage schlecht ist.', o: ['Das ist nicht möglich – der Betrieb kann nur noch fristlos aus wichtigem Grund kündigen.', 'Das ist möglich, wenn der Betriebsrat zustimmt.', 'Das ist mit der gesetzlichen Grundkündigungsfrist möglich.', 'Das ist nur mit Zustimmung der IHK möglich.'], r: 0, e: 'Nach der Probezeit kann der Ausbildende nur noch aus wichtigem Grund ohne Frist kündigen (§ 22 Abs. 2 Nr. 1 BBiG). Schlechte Auftragslage ist kein solcher Grund.' },
        { t: 'Ausbildung', f: 'Ein Azubi (nach der Probezeit) will die Ausbildung beenden, um eine Ausbildung zum Koch zu beginnen.', o: ['Er kann mit einer Frist von vier Wochen kündigen.', 'Er kann nicht kündigen, nur ein Aufhebungsvertrag ist möglich.', 'Er kann nur fristlos kündigen.', 'Er muss bis zum Ende des Ausbildungsjahres bleiben.'], r: 0, e: 'Wer die Berufsausbildung aufgeben oder sich für einen anderen Beruf ausbilden lassen will, kann mit vier Wochen Frist kündigen (§ 22 Abs. 2 Nr. 2 BBiG).' },
        { t: 'Ausbildung', f: 'Wie lange darf die Probezeit in einem Berufsausbildungsverhältnis dauern?', o: ['mindestens 1, höchstens 4 Monate', 'genau 3 Monate', 'höchstens 6 Monate', 'mindestens 2, höchstens 6 Monate'], r: 0, e: '§ 20 BBiG: Die Probezeit muss mindestens einen Monat und darf höchstens vier Monate betragen.' },
        { t: 'Ausbildung', f: 'Ein 19-jähriger Azubi hat dienstags sechs Unterrichtsstunden à 45 Minuten Berufsschule. Der Ausbilder verlangt, dass er danach noch in den Betrieb kommt.', o: ['Er muss nicht kommen: An einem solchen Berufsschultag pro Woche darf er nicht beschäftigt werden.', 'Er muss kommen, weil er volljährig ist.', 'Er muss kommen, die Zeit wird als Überstunde bezahlt.', 'Er muss nur kommen, wenn es im Ausbildungsvertrag steht.'], r: 0, e: 'Seit 2020 gilt die Regel für alle Azubis unabhängig vom Alter: An einem Berufsschultag mit mehr als fünf Unterrichtsstunden à 45 Minuten darf einmal pro Woche nicht im Betrieb beschäftigt werden (§ 15 BBiG).' },
        { t: 'Ausbildung', f: 'Was muss der Ausbildungsbetrieb einem Azubi kostenlos zur Verfügung stellen?', o: ['die Ausbildungsmittel, die für die Ausbildung und die Abschlussprüfung im Betrieb nötig sind', 'die Schulbücher für die Berufsschule', 'einen Dienstwagen für den Weg zur Berufsschule', 'einen privaten Laptop zur freien Verwendung'], r: 0, e: '§ 14 BBiG: Ausbildungsmittel, insbesondere Werkzeuge und Werkstoffe, die zur Berufsausbildung und zur Ablegung der Prüfungen erforderlich sind, stellt der Betrieb kostenlos.' },
        { t: 'Ausbildung', f: 'Ein Azubi besteht die Abschlussprüfung nicht. Was gilt?', o: ['Auf sein Verlangen verlängert sich die Ausbildung bis zur nächsten Wiederholungsprüfung, höchstens um ein Jahr.', 'Die Ausbildung endet automatisch, eine Wiederholung ist nicht möglich.', 'Der Betrieb muss ihn als Fachkraft übernehmen.', 'Er muss die gesamte Ausbildung neu beginnen.'], r: 0, e: '§ 21 Abs. 3 BBiG: Bei Nichtbestehen verlängert sich das Ausbildungsverhältnis auf Verlangen bis zur nächstmöglichen Wiederholungsprüfung, höchstens um ein Jahr.' },
        { t: 'Jugendarbeitsschutz', f: 'Ein 17-jähriger Azubi soll an einem Tag 9 Stunden arbeiten, weil ein Rollout ansteht.', o: ['Unzulässig – Jugendliche dürfen höchstens 8 Stunden täglich arbeiten (Ausnahme: 8,5 Stunden, wenn an anderen Tagen verkürzt).', 'Zulässig, wenn er zustimmt.', 'Zulässig, wenn die Stunde bezahlt wird.', 'Zulässig, da 10 Stunden die Grenze sind.'], r: 0, e: 'JArbSchG § 8: höchstens 8 Stunden täglich und 40 Stunden wöchentlich. Nur wenn an einzelnen Werktagen kürzer gearbeitet wird, sind bis zu 8,5 Stunden an anderen Tagen derselben Woche erlaubt.' },
        { t: 'Jugendarbeitsschutz', f: 'Ein 16-jähriger Azubi arbeitet 7 Stunden. Welche Pausen stehen ihm mindestens zu?', o: ['60 Minuten', '30 Minuten', '45 Minuten', '15 Minuten'], r: 0, e: 'JArbSchG § 11: mehr als 4,5 bis 6 Stunden → 30 Minuten, mehr als 6 Stunden → 60 Minuten Ruhepause. Eine Pause muss mindestens 15 Minuten dauern.' },
        { t: 'Arbeitszeit', f: 'Eine volljährige Mitarbeiterin arbeitet 9,5 Stunden. Welche Pause schreibt das Arbeitszeitgesetz mindestens vor?', o: ['45 Minuten', '30 Minuten', '60 Minuten', 'keine, solange sie zustimmt'], r: 0, e: 'ArbZG § 4: mehr als 6 Stunden → 30 Minuten, mehr als 9 Stunden → 45 Minuten Ruhepause.' },
        { t: 'Arbeitszeit', f: 'Ein Admin hat bis 23 Uhr ein Update eingespielt. Wann darf er frühestens wieder arbeiten?', o: ['um 10 Uhr am nächsten Tag', 'um 7 Uhr am nächsten Tag', 'um 8 Uhr am nächsten Tag', 'sofort, wenn er sich fit fühlt'], r: 0, e: 'ArbZG § 5: Nach Ende der täglichen Arbeitszeit ist eine ununterbrochene Ruhezeit von mindestens 11 Stunden einzuhalten.' },
        { t: 'Kündigung', f: 'Der Chef kündigt einem Mitarbeiter per E-Mail mit eingescannter Unterschrift.', o: ['Die Kündigung ist unwirksam – sie muss schriftlich mit eigenhändiger Unterschrift erfolgen.', 'Die Kündigung ist wirksam, weil die Unterschrift sichtbar ist.', 'Die Kündigung ist wirksam, wenn die E-Mail gelesen wurde.', 'Die Kündigung ist wirksam, wenn eine Lesebestätigung vorliegt.'], r: 0, e: '§ 623 BGB: Kündigung und Aufhebungsvertrag bedürfen der Schriftform; die elektronische Form ist ausgeschlossen. E-Mail, Fax oder Messenger reichen nicht.' },
        { t: 'Kündigung', f: 'Ein Betrieb mit 25 Beschäftigten kündigt einem Mitarbeiter, der seit drei Jahren dort arbeitet, ohne Begründung. Was gilt?', o: ['Das Kündigungsschutzgesetz greift – die Kündigung muss sozial gerechtfertigt sein.', 'Der Arbeitgeber muss nie einen Grund haben.', 'Kündigungsschutz gilt erst nach zehn Jahren Betriebszugehörigkeit.', 'Kündigungsschutz gilt nur für Gewerkschaftsmitglieder.'], r: 0, e: 'Das KSchG gilt, wenn das Arbeitsverhältnis länger als sechs Monate besteht und der Betrieb mehr als zehn Arbeitnehmer hat. Die Kündigung muss dann personen-, verhaltens- oder betriebsbedingt sein.' },
        { t: 'Kündigung', f: 'Ein Mitarbeiter kommt zum ersten Mal unentschuldigt zwei Stunden zu spät. Was ist die angemessene Reaktion des Arbeitgebers?', o: ['eine Abmahnung', 'eine fristlose Kündigung', 'eine ordentliche Kündigung', 'eine Kürzung des Urlaubs'], r: 0, e: 'Vor einer verhaltensbedingten Kündigung ist in der Regel eine Abmahnung nötig: Sie benennt das Fehlverhalten und droht für den Wiederholungsfall arbeitsrechtliche Konsequenzen an.' },
        { t: 'Kündigung', f: 'Ein Unternehmen mit Betriebsrat kündigt einer Mitarbeiterin, ohne den Betriebsrat vorher anzuhören.', o: ['Die Kündigung ist unwirksam.', 'Die Kündigung ist wirksam, der Betriebsrat kann nur nachträglich widersprechen.', 'Die Kündigung ist wirksam, wenn die Frist eingehalten wurde.', 'Die Kündigung wird erst nach einem Monat wirksam.'], r: 0, e: '§ 102 BetrVG: Der Betriebsrat ist vor jeder Kündigung zu hören. Eine ohne Anhörung ausgesprochene Kündigung ist unwirksam.' },
        { t: 'Kündigung', f: 'Eine Mitarbeiterin teilt ihrem Arbeitgeber mit, dass sie schwanger ist. Kurz darauf soll ihr betriebsbedingt gekündigt werden.', o: ['Das ist grundsätzlich verboten – während der Schwangerschaft und bis vier Monate nach der Entbindung besteht Kündigungsschutz.', 'Das ist erlaubt, wenn die Frist eingehalten wird.', 'Das ist erlaubt, wenn sie weniger als ein Jahr im Betrieb ist.', 'Das ist erlaubt, wenn der Betriebsrat zustimmt.'], r: 0, e: '§ 17 MuSchG: Kündigungsverbot während der Schwangerschaft und bis zum Ende von vier Monaten nach der Entbindung. Nur in besonderen Fällen kann die zuständige Behörde eine Kündigung ausnahmsweise zulassen.' },
        { t: 'Betriebsrat', f: 'Die Geschäftsleitung will eine Software einführen, die erfasst, wie lange jede Person an welchem Ticket arbeitet. Welche Rolle hat der Betriebsrat?', o: ['Mitbestimmung – ohne Zustimmung (oder Spruch der Einigungsstelle) darf die Software nicht eingeführt werden.', 'Er muss nur informiert werden.', 'Er kann nur eine Stellungnahme abgeben.', 'Er ist nicht zuständig, das entscheidet allein die IT.'], r: 0, e: '§ 87 Abs. 1 Nr. 6 BetrVG: Die Einführung technischer Einrichtungen, die geeignet sind, Verhalten oder Leistung zu überwachen, ist mitbestimmungspflichtig.' },
        { t: 'Betriebsrat', f: 'Ab welcher Größe kann in einem Betrieb ein Betriebsrat gewählt werden?', o: ['ab 5 ständigen wahlberechtigten Arbeitnehmern, von denen 3 wählbar sind', 'ab 10 Arbeitnehmern', 'ab 20 Arbeitnehmern', 'nur in Kapitalgesellschaften'], r: 0, e: '§ 1 BetrVG: in Betrieben mit in der Regel mindestens fünf ständigen wahlberechtigten Arbeitnehmern, von denen drei wählbar sind.' },
        { t: 'Betriebsrat', f: 'Ein 16-jähriger Azubi fragt, ob er bei der Betriebsratswahl wählen darf.', o: ['Ja, wahlberechtigt ist man ab 16 Jahren.', 'Nein, erst ab 18 Jahren.', 'Nein, Azubis dürfen gar nicht wählen.', 'Ja, aber nur die Jugend- und Auszubildendenvertretung.'], r: 0, e: 'Seit 2021 sind alle Arbeitnehmer ab 16 Jahren bei der Betriebsratswahl wahlberechtigt (§ 7 BetrVG). Wählbar (in den Betriebsrat gewählt werden) ist man ab 18.' },
        { t: 'Betriebsrat', f: 'Wann wird eine Jugend- und Auszubildendenvertretung (JAV) gewählt?', o: ['wenn mindestens 5 Arbeitnehmer unter 18 Jahren oder Auszubildende unter 25 Jahren im Betrieb sind und ein Betriebsrat besteht', 'in jedem Betrieb mit Auszubildenden', 'nur in Betrieben über 100 Beschäftigte', 'wenn die IHK das anordnet'], r: 0, e: '§ 60 BetrVG: In Betrieben mit mindestens fünf Jugendlichen oder Azubis unter 25 wird eine JAV gewählt – sie arbeitet mit dem Betriebsrat zusammen.' },
        { t: 'Tarifrecht', f: 'Während der Laufzeit eines Tarifvertrags ruft die Gewerkschaft zu einem Streik für höhere Löhne auf, obwohl die Löhne im laufenden Vertrag geregelt sind.', o: ['Das verstößt gegen die Friedenspflicht.', 'Das ist jederzeit zulässig.', 'Das ist zulässig, wenn die Inflation hoch ist.', 'Das ist zulässig, wenn der Arbeitgeberverband zustimmt.'], r: 0, e: 'Während der Laufzeit eines Tarifvertrags gilt die Friedenspflicht: Über die darin geregelten Punkte darf nicht gestreikt werden.' },
        { t: 'Tarifrecht', f: 'Der Tarifvertrag sieht 30 Urlaubstage vor, der Arbeitsvertrag eines Tarifbeschäftigten nur 26. Was gilt?', o: ['30 Tage – vom Tarifvertrag darf nur zugunsten des Arbeitnehmers abgewichen werden.', '26 Tage, weil der Arbeitsvertrag spezieller ist.', '28 Tage als Mittelwert.', '24 Tage, der gesetzliche Mindesturlaub.'], r: 0, e: 'Günstigkeitsprinzip: Abweichungen vom Tarifvertrag sind nur zulässig, wenn sie für den Arbeitnehmer günstiger sind.' },
        { t: 'Sozialversicherung', f: 'Ein Azubi verunglückt auf dem direkten Weg von der Berufsschule zum Betrieb. Welche Versicherung ist zuständig?', o: ['die gesetzliche Unfallversicherung (Berufsgenossenschaft)', 'die Krankenversicherung', 'die private Haftpflichtversicherung', 'die Rentenversicherung'], r: 0, e: 'Wegeunfälle auf dem direkten Weg zur Arbeit oder Berufsschule sind über die gesetzliche Unfallversicherung abgesichert. Träger sind die Berufsgenossenschaften.' },
        { t: 'Sozialversicherung', f: 'Wer zahlt die Beiträge zur gesetzlichen Unfallversicherung?', o: ['allein der Arbeitgeber', 'Arbeitgeber und Arbeitnehmer je zur Hälfte', 'allein der Arbeitnehmer', 'der Staat aus Steuermitteln'], r: 0, e: 'Die Unfallversicherung ist der einzige Zweig, den der Arbeitgeber allein finanziert.' },
        { t: 'Sozialversicherung', f: 'Ein Mitarbeiter ist krank. Wie lange zahlt der Arbeitgeber das Gehalt weiter?', o: ['bis zu 6 Wochen je Krankheit, danach Krankengeld der Krankenkasse', 'unbegrenzt', 'bis zu 3 Tage', 'bis zu 6 Monate'], r: 0, e: 'Entgeltfortzahlungsgesetz: Nach vier Wochen Beschäftigung zahlt der Arbeitgeber bis zu sechs Wochen das volle Entgelt. Danach zahlt die Krankenkasse Krankengeld.' },
        { t: 'Sozialversicherung', f: 'Welcher Zweig gehört NICHT zur gesetzlichen Sozialversicherung?', o: ['die Haftpflichtversicherung', 'die Pflegeversicherung', 'die Arbeitslosenversicherung', 'die Unfallversicherung'], r: 0, e: 'Die fünf Zweige sind Kranken-, Pflege-, Renten-, Arbeitslosen- und Unfallversicherung. Die Haftpflichtversicherung ist eine freiwillige Privatversicherung.' },
        { t: 'Geschäftsfähigkeit', f: 'Der 15-jährige Tim kauft von seinem Taschengeld ein gebrauchtes Smartphone für 120 €. Die Eltern sind dagegen.', o: ['Der Vertrag ist wirksam, wenn Tim mit eigenem Taschengeld sofort voll bezahlt hat.', 'Der Vertrag ist immer nichtig.', 'Der Vertrag ist immer schwebend unwirksam.', 'Der Vertrag ist wirksam, weil Tim über 14 ist.'], r: 0, e: 'Taschengeldparagraph § 110 BGB: Ein Vertrag eines beschränkt Geschäftsfähigen ist wirksam, wenn er die Leistung mit Mitteln bewirkt, die ihm zu diesem Zweck oder zur freien Verfügung überlassen wurden. Ratenkäufe fallen nicht darunter.' },
        { t: 'Geschäftsfähigkeit', f: 'Die 16-jährige Mia schließt ohne Wissen ihrer Eltern einen Handyvertrag mit 24 Monaten Laufzeit ab.', o: ['Der Vertrag ist schwebend unwirksam, bis die Eltern ihn genehmigen oder ablehnen.', 'Der Vertrag ist voll wirksam.', 'Der Vertrag ist von Anfang an nichtig.', 'Der Vertrag ist wirksam, aber Mia kann jederzeit kündigen.'], r: 0, e: 'Beschränkt Geschäftsfähige (7–17 Jahre) brauchen für Verträge, die nicht lediglich rechtlich vorteilhaft sind, die Zustimmung der gesetzlichen Vertreter. Bis zur Genehmigung ist der Vertrag schwebend unwirksam (§ 108 BGB).' },
        { t: 'Kaufvertrag', f: 'Ein Kunde kauft im Laden ein neues Notebook. Nach drei Monaten fällt das Display aus. Was kann er zuerst verlangen?', o: ['Nacherfüllung – nach seiner Wahl Reparatur oder ein neues Gerät', 'sofort sein Geld zurück', 'sofort einen Preisnachlass', 'nichts, die Garantie des Herstellers ist abgelaufen'], r: 0, e: 'Bei einem Mangel hat die Nacherfüllung Vorrang (§ 439 BGB). Erst wenn sie fehlschlägt oder verweigert wird, kommen Rücktritt, Minderung oder Schadensersatz in Frage.' },
        { t: 'Kaufvertrag', f: 'Ein Verbraucher reklamiert nach acht Monaten einen Defekt an einem neu gekauften Drucker. Wer muss beweisen, ob der Mangel schon beim Kauf vorlag?', o: ['Der Verkäufer – innerhalb eines Jahres wird vermutet, dass der Mangel schon bei Übergabe bestand.', 'Der Käufer, und zwar immer.', 'Niemand, die Gewährleistung ist abgelaufen.', 'Der Hersteller.'], r: 0, e: 'Beim Verbrauchsgüterkauf gilt seit 2022 eine Beweislastumkehr von einem Jahr ab Übergabe (§ 477 BGB).' },
        { t: 'Kaufvertrag', f: 'Was ist der Unterschied zwischen Gewährleistung und Garantie?', o: ['Gewährleistung ist gesetzlich und gilt gegenüber dem Verkäufer; eine Garantie ist eine freiwillige Zusage, meist des Herstellers.', 'Beides ist dasselbe.', 'Die Garantie ist gesetzlich, die Gewährleistung freiwillig.', 'Gewährleistung gibt es nur bei gebrauchten Waren.'], r: 0, e: 'Die gesetzliche Mängelhaftung (Gewährleistung) beträgt bei neuen Sachen zwei Jahre. Eine Garantie kann zusätzlich freiwillig gegeben werden, ihre Bedingungen legt der Garantiegeber fest.' },
        { t: 'Kaufvertrag', f: 'Eine Privatperson bestellt online einen Monitor. Wie lange kann sie den Vertrag ohne Angabe von Gründen widerrufen?', o: ['14 Tage ab Erhalt der Ware (bei ordnungsgemäßer Belehrung)', '7 Tage', '30 Tage', 'gar nicht, Kauf ist Kauf'], r: 0, e: 'Bei Fernabsatzverträgen haben Verbraucher ein Widerrufsrecht von 14 Tagen (§ 355 BGB). Zwischen Unternehmen gibt es dieses Recht nicht.' },
        { t: 'Rechtsformen', f: 'Zwei Freundinnen gründen ein IT-Systemhaus und wollen nicht mit ihrem Privatvermögen haften. Sie haben 25.000 € Startkapital.', o: ['GmbH', 'OHG', 'GbR', 'Einzelunternehmen (e. K.)'], r: 0, e: 'Bei der GmbH haftet nur das Gesellschaftsvermögen. Das Mindeststammkapital beträgt 25.000 €. Bei OHG und GbR haften alle Gesellschafter unbeschränkt mit ihrem Privatvermögen.' },
        { t: 'Rechtsformen', f: 'In einer KG haftet der Kommanditist …', o: ['nur bis zur Höhe seiner Einlage.', 'unbeschränkt mit seinem Privatvermögen.', 'gar nicht.', 'nur, wenn er Geschäftsführer ist.'], r: 0, e: 'In der KG haftet mindestens ein Komplementär unbeschränkt; Kommanditisten haften nur bis zur Höhe ihrer Einlage.' },
        { t: 'Rechtsformen', f: 'Ein Gründer möchte eine haftungsbeschränkte Gesellschaft, hat aber nur 1.000 € Kapital.', o: ['Unternehmergesellschaft (haftungsbeschränkt)', 'Aktiengesellschaft', 'GmbH', 'Kommanditgesellschaft'], r: 0, e: 'Die UG (haftungsbeschränkt) ist eine GmbH-Variante, die schon ab 1 € Stammkapital gegründet werden kann. Sie muss jährlich 25 % ihres Gewinns als Rücklage ansparen, bis 25.000 € erreicht sind.' },
        { t: 'Vollmachten', f: 'Ein Prokurist möchte das Betriebsgrundstück verkaufen. Darf er das?', o: ['Nein, dafür braucht er eine besondere Befugnis.', 'Ja, Prokura umfasst alle Geschäfte.', 'Ja, wenn der Kaufpreis unter 1 Million Euro liegt.', 'Nur mit Zustimmung des Betriebsrats.'], r: 0, e: 'Die Prokura deckt fast alle Geschäfte eines Handelsgewerbes, aber nicht die Veräußerung und Belastung von Grundstücken (§ 49 HGB). Sie wird ins Handelsregister eingetragen.' },
        { t: 'Vollmachten', f: 'Eine Teamleiterin darf laut Arbeitsvertrag Büromaterial und Kleinhardware für die Abteilung bestellen. Um welche Vollmacht handelt es sich?', o: ['Handlungsvollmacht (Art- bzw. Einzelvollmacht)', 'Prokura', 'Generalvollmacht', 'Gesamtprokura'], r: 0, e: 'Die Handlungsvollmacht (§ 54 HGB) deckt gewöhnliche Geschäfte im jeweiligen Betrieb – als Einzel-, Art- oder allgemeine Handlungsvollmacht. Sie wird nicht ins Handelsregister eingetragen.' },
        { t: 'Mahnung & Verjährung', f: 'Ein Kunde erhält einen gerichtlichen Mahnbescheid, hält die Forderung aber für unberechtigt. Was sollte er tun?', o: ['innerhalb von zwei Wochen Widerspruch einlegen', 'nichts, ein Mahnbescheid hat keine Folgen', 'sofort zahlen, sonst wird gepfändet', 'beim Betriebsrat Beschwerde einlegen'], r: 0, e: 'Gegen den Mahnbescheid kann innerhalb von zwei Wochen Widerspruch eingelegt werden. Ohne Widerspruch kann der Gläubiger einen Vollstreckungsbescheid beantragen – das ist ein vollstreckbarer Titel.' },
        { t: 'Mahnung & Verjährung', f: 'Eine Rechnung über eine IT-Dienstleistung wurde am 10. März 2025 fällig. Wann verjährt die Forderung regelmäßig?', o: ['mit Ablauf des 31.12.2028', 'am 10.03.2028', 'mit Ablauf des 31.12.2027', 'am 10.03.2030'], r: 0, e: 'Die regelmäßige Verjährungsfrist beträgt drei Jahre und beginnt mit dem Schluss des Jahres, in dem der Anspruch entstanden ist (§§ 195, 199 BGB): 31.12.2025 + 3 Jahre.' },
        { t: 'Arbeitsvertrag', f: 'Ein Mitarbeiter verlässt das Unternehmen und verlangt ein Zeugnis, das auch seine Leistung und sein Verhalten beurteilt.', o: ['Er hat Anspruch auf ein qualifiziertes Arbeitszeugnis.', 'Er hat nur Anspruch auf eine Arbeitsbescheinigung.', 'Ein Zeugnis gibt es nur nach zehn Jahren Betriebszugehörigkeit.', 'Der Arbeitgeber kann frei entscheiden, ob er ein Zeugnis ausstellt.'], r: 0, e: 'Arbeitnehmer haben Anspruch auf ein einfaches Zeugnis (Art und Dauer) oder auf Verlangen auf ein qualifiziertes Zeugnis mit Leistung und Verhalten (§ 109 GewO). Es muss wohlwollend und wahr sein.' },
        { t: 'Arbeitsvertrag', f: 'Welche Pflicht hat der Arbeitnehmer aus dem Arbeitsvertrag?', o: ['Arbeitspflicht und Verschwiegenheit über Betriebsgeheimnisse', 'Vergütungspflicht', 'Fürsorgepflicht', 'Pflicht zur Ausstellung eines Zeugnisses'], r: 0, e: 'Arbeitnehmer: Arbeitspflicht, Treuepflicht (z. B. Verschwiegenheit, Wettbewerbsverbot). Arbeitgeber: Vergütungspflicht, Fürsorgepflicht, Zeugnispflicht, Beschäftigungspflicht.' },
        { t: 'Wirtschaft', f: 'Ein Systemhaus will einen festen Umsatz mit möglichst geringem Personaleinsatz erzielen. Nach welchem Prinzip handelt es?', o: ['Minimalprinzip', 'Maximalprinzip', 'Solidaritätsprinzip', 'Subsidiaritätsprinzip'], r: 0, e: 'Ökonomisches Prinzip: Minimalprinzip = ein gegebenes Ziel mit möglichst geringem Mitteleinsatz; Maximalprinzip = mit gegebenen Mitteln ein möglichst großes Ergebnis.' },
        { t: 'Wirtschaft', f: 'Auf einem Markt stehen wenige große Anbieter vielen Nachfragern gegenüber (z. B. Mobilfunknetze). Welche Marktform ist das?', o: ['Angebotsoligopol', 'Polypol', 'Angebotsmonopol', 'Nachfragemonopol'], r: 0, e: 'Wenige Anbieter, viele Nachfrager: Angebotsoligopol. Ein Anbieter: Monopol. Viele Anbieter und viele Nachfrager: Polypol.' },
        { t: 'Wirtschaft', f: 'Was passiert im Marktmodell, wenn die Nachfrage nach Grafikkarten bei gleichem Angebot stark steigt?', o: ['Der Gleichgewichtspreis steigt.', 'Der Gleichgewichtspreis sinkt.', 'Der Preis bleibt gleich, nur die Menge steigt.', 'Das Angebot sinkt automatisch.'], r: 0, e: 'Steigt die Nachfrage bei unverändertem Angebot, verschiebt sich die Nachfragekurve nach rechts: Gleichgewichtspreis und -menge steigen.' },
        { t: 'Lohn & Steuern', f: 'Eine alleinerziehende Mitarbeiterin mit einem Kind fragt nach ihrer Lohnsteuerklasse.', o: ['Steuerklasse II', 'Steuerklasse I', 'Steuerklasse III', 'Steuerklasse V'], r: 0, e: 'Klasse I: ledig; II: alleinerziehend (Entlastungsbetrag); III/V oder IV/IV: verheiratet; VI: zweites und jedes weitere Arbeitsverhältnis.' },
        { t: 'Lohn & Steuern', f: 'Was wird vom Bruttogehalt NICHT abgezogen?', o: ['der Arbeitgeberanteil zur Rentenversicherung', 'die Lohnsteuer', 'der Arbeitnehmeranteil zur Krankenversicherung', 'gegebenenfalls die Kirchensteuer'], r: 0, e: 'Netto = Brutto − Lohnsteuer − Solidaritätszuschlag (falls fällig) − Kirchensteuer − Arbeitnehmeranteile zur Sozialversicherung. Den Arbeitgeberanteil zahlt der Arbeitgeber zusätzlich.' },
        { t: 'Mutterschutz & Elternzeit', f: 'Wie lange darf eine Mitarbeiterin nach der Geburt ihres Kindes im Regelfall nicht beschäftigt werden?', o: ['8 Wochen', '6 Wochen', '12 Wochen', '4 Wochen'], r: 0, e: 'MuSchG § 3: Schutzfrist sechs Wochen vor und acht Wochen nach der Entbindung (bei Früh- oder Mehrlingsgeburten zwölf Wochen nach der Geburt).' },
        { t: 'Mutterschutz & Elternzeit', f: 'Ein Vater möchte direkt nach der Geburt Elternzeit nehmen. Wie lange vorher muss er sie spätestens schriftlich verlangen?', o: ['7 Wochen', '4 Wochen', '3 Monate', 'gar nicht, er kann sofort zu Hause bleiben'], r: 0, e: 'Elternzeit muss für die Zeit bis zum dritten Geburtstag spätestens sieben Wochen vor Beginn schriftlich verlangt werden (§ 16 BEEG). Insgesamt sind bis zu drei Jahre pro Kind möglich.' },
        { t: 'Kündigung', f: 'Herr Weber arbeitet seit 14 Jahren in einem Rechenzentrum. Er hat eine neue Stelle gefunden und kündigt selbst. Im Vertrag stehen nur die gesetzlichen Fristen. Welche Frist muss er einhalten?', o: ['4 Wochen zum 15. oder zum Monatsende', '5 Monate zum Monatsende', '6 Monate zum Monatsende', '2 Wochen zu jedem Tag'], r: 0, e: 'Die verlängerten Fristen aus § 622 Abs. 2 BGB gelten nur, wenn der Arbeitgeber kündigt. Kündigt der Arbeitnehmer, bleibt es bei der Grundfrist von 4 Wochen zum 15. oder zum Monatsende – egal, wie lange er schon im Betrieb ist.' },
        { t: 'Kündigung', f: 'Eine Arbeitgeberin erfährt am 2. Mai, dass ein Mitarbeiter Firmenlaptops verkauft hat. Die fristlose Kündigung spricht sie erst am 10. Juni aus.', o: ['Die fristlose Kündigung kommt zu spät – sie muss innerhalb von zwei Wochen nach Kenntnis des Grundes erklärt werden.', 'Die fristlose Kündigung ist wirksam, Diebstahl ist immer ein wichtiger Grund.', 'Eine fristlose Kündigung ist nur nach einer Anzeige bei der Polizei möglich.', 'Die fristlose Kündigung ist wirksam, wenn vorher abgemahnt wurde.'], r: 0, e: '§ 626 Abs. 2 BGB: Eine außerordentliche (fristlose) Kündigung muss innerhalb von zwei Wochen erklärt werden, nachdem der Kündigungsberechtigte vom wichtigen Grund erfahren hat. Danach bleibt nur noch die ordentliche Kündigung mit Frist.' },
        { t: 'Kündigung', f: 'Ein Mitarbeiter hält seine Kündigung für sozial ungerechtfertigt. Was muss er beachten?', o: ['Er muss innerhalb von drei Wochen nach Zugang der Kündigung Klage beim Arbeitsgericht erheben.', 'Er kann sich bis zum Ende der Kündigungsfrist Zeit lassen.', 'Er muss die Klage beim Betriebsrat einreichen.', 'Er kann innerhalb eines Jahres beim Amtsgericht klagen.'], r: 0, e: '§ 4 KSchG: Die Kündigungsschutzklage muss innerhalb von drei Wochen nach Zugang der schriftlichen Kündigung beim Arbeitsgericht eingehen. Versäumt er die Frist, gilt die Kündigung als von Anfang an wirksam (§ 7 KSchG).' },
        { t: 'Arbeitsvertrag', f: 'Arbeitgeber und Mitarbeiterin wollen das Arbeitsverhältnis einvernehmlich zum Monatsende beenden. Was trifft auf einen Aufhebungsvertrag zu?', o: ['Er braucht die Schriftform; Kündigungsfristen und Anhörung des Betriebsrats entfallen, beim Arbeitslosengeld kann aber eine Sperrzeit drohen.', 'Er kann auch mündlich geschlossen werden.', 'Er ist nur mit Zustimmung des Betriebsrats wirksam.', 'Er muss die gesetzliche Kündigungsfrist einhalten.'], r: 0, e: 'Beim Aufhebungsvertrag einigen sich beide Seiten auf das Ende – Kündigungsfristen und Kündigungsschutz spielen keine Rolle. § 623 BGB verlangt die Schriftform. Weil man an der eigenen Arbeitslosigkeit mitwirkt, kann die Agentur für Arbeit eine Sperrzeit beim Arbeitslosengeld verhängen.' },
        { t: 'Ausbildung', f: 'Ein Azubi fragt, ob er den Ausbildungsnachweis (das „Berichtsheft“) wirklich führen muss.', o: ['Ja – er muss ihn führen, der Betrieb muss ihm dafür Zeit während der Ausbildungszeit geben, und ohne Nachweis gibt es keine Zulassung zur Abschlussprüfung.', 'Nein, der Nachweis ist freiwillig.', 'Nur, solange er noch nicht volljährig ist.', 'Ja, aber nur in seiner Freizeit.'], r: 0, e: 'Azubis müssen einen Ausbildungsnachweis führen (§ 13 BBiG). Der Betrieb hält dazu an, sieht ihn regelmäßig durch und lässt ihn während der Ausbildungszeit führen (§ 14 BBiG). Er ist Voraussetzung für die Zulassung zur Abschlussprüfung (§ 43 BBiG).' },
        { t: 'Ausbildung', f: 'Gilt der gesetzliche Mindestlohn auch für Auszubildende?', o: ['Nein – für sie gilt die Mindestausbildungsvergütung nach dem BBiG, sofern kein Tarifvertrag gilt.', 'Ja, ab dem ersten Ausbildungstag.', 'Ja, aber erst ab dem 18. Geburtstag.', 'Nein, Azubis haben keinen Anspruch auf eine Vergütung.'], r: 0, e: 'Das Mindestlohngesetz gilt nicht für die Berufsausbildung. Azubis haben stattdessen Anspruch auf eine angemessene Vergütung, mindestens die Mindestausbildungsvergütung nach § 17 BBiG. Sie steigt mit jedem Ausbildungsjahr.' },
        { t: 'Datenschutz', f: 'Ein Kunde möchte wissen, welche personenbezogenen Daten euer Webshop über ihn gespeichert hat.', o: ['Er hat ein Auskunftsrecht; die Auskunft muss in der Regel innerhalb eines Monats und kostenlos erteilt werden.', 'Das Unternehmen muss nur antworten, wenn er einen Anwalt einschaltet.', 'Auskunft gibt es nur gegen eine Bearbeitungsgebühr.', 'Gespeicherte Kundendaten sind Betriebsgeheimnis.'], r: 0, e: 'Art. 15 DSGVO gibt jeder betroffenen Person ein Auskunftsrecht. Nach Art. 12 DSGVO ist die Auskunft unverzüglich, spätestens innerhalb eines Monats zu erteilen; die erste Kopie ist kostenlos.' },
        { t: 'Datenschutz', f: 'Ein Online-Händler will die E-Mail-Adressen seiner Kunden für einen Werbe-Newsletter nutzen. Was braucht er in der Regel?', o: ['eine ausdrückliche Einwilligung (z. B. per Double-Opt-in), die jederzeit widerrufen werden kann', 'nichts, die Adressen liegen ja schon vor', 'die Zustimmung des Betriebsrats', 'eine Genehmigung der IHK'], r: 0, e: 'Werbe-E-Mails brauchen grundsätzlich eine Einwilligung (Art. 6 Abs. 1 lit. a DSGVO, § 7 UWG). In der Praxis wird sie per Double-Opt-in nachgewiesen. Die Einwilligung kann jederzeit widerrufen werden.' },
        { t: 'Arbeitsschutz', f: 'Eine Mitarbeiterin arbeitet täglich am Bildschirm und bekommt Probleme mit den Augen. Was gilt?', o: ['Der Arbeitgeber muss eine arbeitsmedizinische Vorsorge mit Augenuntersuchung anbieten und eine nötige spezielle Bildschirmbrille bezahlen.', 'Sie muss die Untersuchung selbst bezahlen.', 'Der Arbeitgeber muss nichts tun, Augenprobleme sind Privatsache.', 'Für Bildschirmbrillen ist allein die Krankenkasse zuständig.'], r: 0, e: 'Nach der Verordnung zur arbeitsmedizinischen Vorsorge (ArbMedVV) muss der Arbeitgeber bei Bildschirmarbeit eine Vorsorge anbieten. Ist eine spezielle Sehhilfe für die Bildschirmarbeit nötig, stellt er sie zur Verfügung.' },
        { t: 'Arbeitsschutz', f: 'Wer ist im Betrieb dafür verantwortlich, dass die Arbeitsschutzvorschriften eingehalten werden?', o: ['der Arbeitgeber – er muss unter anderem Gefährdungen beurteilen und die Beschäftigten unterweisen', 'jeder Beschäftigte allein für sich', 'ausschließlich die Berufsgenossenschaft', 'der Betriebsrat'], r: 0, e: 'Das Arbeitsschutzgesetz nimmt den Arbeitgeber in die Pflicht: Gefährdungsbeurteilung (§ 5 ArbSchG), Schutzmaßnahmen und Unterweisung (§ 12 ArbSchG). Die Beschäftigten müssen mitwirken; Berufsgenossenschaft und Gewerbeaufsicht überwachen.' },
        { t: 'Kaufvertrag', f: 'In einem Webshop steht ein Notebook durch einen Tippfehler für 49 € statt 1.490 €. Ein Kunde bestellt sofort. Wann ist ein Kaufvertrag zustande gekommen?', o: ['Erst wenn der Shop die Bestellung annimmt – die Anzeige im Shop ist nur eine Aufforderung, ein Angebot abzugeben.', 'Schon mit dem Klick auf „Kaufen“.', 'Sobald die automatische Eingangsbestätigung eintrifft.', 'Nie – Kaufverträge im Internet brauchen eine Unterschrift.'], r: 0, e: 'Ein Kaufvertrag entsteht durch zwei übereinstimmende Willenserklärungen: Antrag und Annahme. Die Darstellung im Shop ist nur eine Aufforderung zur Abgabe eines Angebots; die Bestellung ist der Antrag. Eine bloße Eingangsbestätigung ist noch keine Annahme.' },
        { t: 'Kaufvertrag', f: 'Im Vertrag steht „Lieferung spätestens am 15. März“. Die Ware kommt nicht. Muss der Käufer den Verkäufer erst mahnen, damit dieser in Verzug gerät?', o: ['Nein – der Termin ist kalendermäßig bestimmt, der Verzug tritt ohne Mahnung ein.', 'Ja, ohne Mahnung gibt es nie einen Verzug.', 'Ja, und zwar per Einschreiben.', 'Nein, aber nur bei Verträgen zwischen Privatpersonen.'], r: 0, e: '§ 286 Abs. 2 Nr. 1 BGB: Ist der Leistungszeitpunkt nach dem Kalender bestimmt, gerät der Schuldner ohne Mahnung in Verzug. Bei unbestimmten Angaben wie „Lieferung im Frühjahr“ ist eine Mahnung nötig.' },
        { t: 'Kaufvertrag', f: 'Ein Unternehmen schickt einem Geschäftskunden eine Rechnung ohne Zahlungsziel. Wann gerät der Kunde spätestens in Zahlungsverzug, wenn er nicht zahlt?', o: ['30 Tage nach Fälligkeit und Zugang der Rechnung', 'sofort mit Zugang der Rechnung', 'nach 14 Tagen', 'erst nach der dritten Mahnung'], r: 0, e: '§ 286 Abs. 3 BGB: Ohne Mahnung tritt der Verzug spätestens 30 Tage nach Fälligkeit und Zugang der Rechnung ein. Bei Verbrauchern gilt das nur, wenn die Rechnung auf diese Folge hinweist.' },
        { t: 'Betriebsrat', f: 'Für wie lange wird ein Betriebsrat regulär gewählt?', o: ['4 Jahre', '2 Jahre', '3 Jahre', '5 Jahre'], r: 0, e: '§ 21 BetrVG: Die regelmäßige Amtszeit des Betriebsrats beträgt vier Jahre. Die Jugend- und Auszubildendenvertretung wird für zwei Jahre gewählt.' },
        { t: 'Organisation', f: 'Eine Entwicklerin bekommt fachliche Anweisungen von ihrer Projektleiterin und disziplinarische vom Abteilungsleiter. Welche Organisationsform liegt vor?', o: ['Matrixorganisation', 'Einliniensystem', 'Stabliniensystem', 'Spartenorganisation'], r: 0, e: 'In der Matrixorganisation überlagern sich zwei Leitungslinien (z. B. Funktion und Projekt) – Beschäftigte haben zwei Vorgesetzte. Im Einliniensystem gibt es genau einen Vorgesetzten; im Stabliniensystem kommen beratende Stabsstellen ohne Weisungsrecht hinzu.' },
        { t: 'Wirtschaft', f: 'Welches Ziel gehört NICHT zum „magischen Viereck“ des Stabilitätsgesetzes?', o: ['gerechte Einkommens- und Vermögensverteilung', 'stabiles Preisniveau', 'hoher Beschäftigungsstand', 'außenwirtschaftliches Gleichgewicht'], r: 0, e: 'Magisches Viereck (§ 1 StabG): stabiles Preisniveau, hoher Beschäftigungsstand, außenwirtschaftliches Gleichgewicht und stetiges, angemessenes Wirtschaftswachstum. Gerechte Verteilung und Umweltschutz erweitern es zum magischen Sechseck.' },
        { t: 'Sozialversicherung', f: 'Wer ist Träger der gesetzlichen Rentenversicherung?', o: ['die Deutsche Rentenversicherung', 'die Berufsgenossenschaft', 'die Bundesagentur für Arbeit', 'die Krankenkasse'], r: 0, e: 'Träger der fünf Zweige: Krankenversicherung → Krankenkassen, Pflegeversicherung → Pflegekassen, Rentenversicherung → Deutsche Rentenversicherung, Arbeitslosenversicherung → Bundesagentur für Arbeit, Unfallversicherung → Berufsgenossenschaften und Unfallkassen.' },
        { t: 'Lohn & Steuern', f: 'Ein Mitarbeiter hat neben seiner Vollzeitstelle einen zweiten, regulär versteuerten Job. Nach welcher Steuerklasse wird der Zweitjob abgerechnet?', o: ['Steuerklasse VI', 'Steuerklasse I', 'Steuerklasse V', 'Steuerklasse II'], r: 0, e: 'Für das zweite und jedes weitere Arbeitsverhältnis gilt Steuerklasse VI. Minijobs werden dagegen meist pauschal versteuert.' }
    ];

    /** Denkanstöße je Themengebiet: Tipp-Knopf und Hinweis nach einer falschen Antwort. */
    const THEMEN = {
        'Ausbildung': 'Alles zur Ausbildung regelt das Berufsbildungsgesetz (BBiG). Frag dich: Läuft noch die Probezeit? Wer handelt – Azubi oder Betrieb? Welche Pflichten hat welche Seite?',
        'Jugendarbeitsschutz': 'Für unter 18-Jährige gilt das Jugendarbeitsschutzgesetz. Es ist strenger als das Arbeitszeitgesetz: höchstens 8 Stunden am Tag, längere Pausen, mehr Urlaub.',
        'Arbeitszeit': 'Das Arbeitszeitgesetz staffelt die Pausen nach der Arbeitsdauer (mehr als 6 bzw. mehr als 9 Stunden) und verlangt eine ununterbrochene Ruhezeit zwischen zwei Arbeitstagen.',
        'Kündigung': 'Geh die Prüfschritte durch: Form (schriftlich mit Unterschrift?), Frist (wer kündigt, wie lange im Betrieb?), Kündigungsschutz (KSchG, Mutterschutz …) und Beteiligung des Betriebsrats.',
        'Betriebsrat': 'Das Betriebsverfassungsgesetz unterscheidet Information, Anhörung und echte Mitbestimmung. Bei Mitbestimmung geht es nicht ohne Zustimmung des Betriebsrats.',
        'Tarifrecht': 'Tarifverträge setzen Mindestbedingungen – abweichen darf man nur zugunsten der Beschäftigten. Während der Laufzeit gilt die Friedenspflicht.',
        'Sozialversicherung': 'Fünf Zweige: Kranken-, Pflege-, Renten-, Arbeitslosen- und Unfallversicherung. Wer zahlt jeweils die Beiträge, und wer ist der Träger?',
        'Geschäftsfähigkeit': 'Entscheidend ist das Alter: unter 7 geschäftsunfähig, 7 bis 17 beschränkt geschäftsfähig, ab 18 voll geschäftsfähig. Wichtige Ausnahme: der Taschengeldparagraf.',
        'Kaufvertrag': 'Wie kommt der Vertrag zustande (Antrag und Annahme)? Was gilt bei Mängeln, Verzug oder Widerruf? Und: Ist der Käufer Verbraucher oder Unternehmer?',
        'Rechtsformen': 'Rechtsformen unterscheiden sich vor allem bei der Haftung (beschränkt oder auch mit dem Privatvermögen) und beim Mindestkapital.',
        'Vollmachten': 'Prokura steht im Handelsregister und erlaubt fast alle Geschäfte – mit wenigen Ausnahmen. Die Handlungsvollmacht deckt nur gewöhnliche Geschäfte und wird nicht eingetragen.',
        'Mahnung & Verjährung': 'Gerichtliches Mahnverfahren: Mahnbescheid → Widerspruch innerhalb von 2 Wochen → sonst Vollstreckungsbescheid. Die regelmäßige Verjährung beginnt erst mit dem Schluss des Jahres.',
        'Arbeitsvertrag': 'Aus dem Arbeitsvertrag folgen Pflichten für beide Seiten: Was schuldet der Arbeitnehmer, was der Arbeitgeber? Und welche Form braucht ein Vertrag, der das Arbeitsverhältnis beendet?',
        'Wirtschaft': 'Denk an die Grundbegriffe: ökonomisches Prinzip, Marktformen (Zahl der Anbieter und Nachfrager), Preisbildung durch Angebot und Nachfrage, gesamtwirtschaftliche Ziele.',
        'Lohn & Steuern': 'Die Steuerklasse hängt vom Familienstand und von der Zahl der Arbeitsverhältnisse ab. Netto = Brutto − Steuern − Arbeitnehmeranteile zur Sozialversicherung.',
        'Mutterschutz & Elternzeit': 'Mutterschutzgesetz: Schutzfristen vor und nach der Geburt, Kündigungsverbot. Elternzeit (BEEG): bis zu 3 Jahre je Kind, rechtzeitig schriftlich verlangen.',
        'Datenschutz': 'Die DSGVO gibt Betroffenen Rechte (Auskunft, Berichtigung, Löschung) und verlangt für jede Verarbeitung eine Rechtsgrundlage – zum Beispiel eine Einwilligung.',
        'Arbeitsschutz': 'Nach dem Arbeitsschutzgesetz ist der Arbeitgeber verantwortlich: Er beurteilt Gefährdungen und unterweist die Beschäftigten. Für Bildschirmarbeit gibt es eigene Regeln.',
        'Organisation': 'Wie viele Vorgesetzte hat eine Stelle, und gibt es beratende Stabsstellen? Daran unterscheidest du Einlinien-, Mehrlinien-, Stablinien- und Matrixorganisation.'
    };

    const naechsterFall = deck(FAELLE);

    function fallAufgabe(rng) {
        const fall = naechsterFall(rng);
        const reihenfolge = rng.shuffle(fall.o.map((text, i) => ({ text, richtig: i === fall.r })));
        const name = 'fall-' + Math.random().toString(36).slice(2, 8);
        const optionen = [];
        const denkanstoss = THEMEN[fall.t] || 'Lies genau, wer handelt (Arbeitgeber oder Arbeitnehmer, Azubi oder Fachkraft, Verbraucher oder Unternehmen) – davon hängt die Regel oft ab.';
        return {
            title: fall.t,
            description: 'Wähle die zutreffende Antwort.',
            hint: denkanstoss,
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, fall.f));
                const liste = h('div', { class: 'game-choices', role: 'radiogroup', 'aria-label': 'Antworten' });
                reihenfolge.forEach((opt, i) => {
                    const input = h('input', { type: 'radio', name, class: 'form-check-input', value: i });
                    const label = h('label', { class: 'game-choice' }, input, h('span', {}, opt.text));
                    optionen.push({ input, label, opt });
                    liste.append(label);
                });
                body.append(liste);
            },
            check() {
                const gewaehlt = optionen.find((o) => o.input.checked);
                optionen.forEach((o) => o.label.classList.remove('is-valid', 'is-invalid'));
                if (!gewaehlt) return { correct: false, score: 0, message: 'Bitte eine Antwort auswählen.' };
                gewaehlt.label.classList.add(gewaehlt.opt.richtig ? 'is-valid' : 'is-invalid');
                if (gewaehlt.opt.richtig) return { correct: true, score: 1, message: fall.e };
                return { correct: false, score: 0, message: 'Diese Antwort trifft nicht zu. Versuch es noch einmal – oder lass dir die Lösung mit Erklärung zeigen.', tipps: ['Denkanstoß: ' + denkanstoss] };
            },
            showSolution(box) {
                optionen.forEach((o) => {
                    o.label.classList.toggle('is-valid', o.opt.richtig);
                    o.label.classList.remove('is-invalid');
                    o.input.checked = o.opt.richtig;
                });
                box.append(h('h3', {}, 'Erklärung'), h('p', { class: 'mb-0' }, fall.e));
            }
        };
    }

    // ---------- Zahlen und Fristen ----------

    // g: Themengruppe für die Lernkarte, i: kurze Erklärung mit Fundstelle, t: typische Verwechslungen
    const FAKTEN = [
        { g: 'Ausbildung und Jugendliche', f: 'Höchstdauer der Probezeit in der Ausbildung', a: 4, e: 'Monate', i: '§ 20 BBiG: mindestens 1, höchstens 4 Monate.', t: [[6, 'Höchstens 6 Monate gelten für die Probezeit im normalen Arbeitsverhältnis – in der Ausbildung sind es höchstens 4.']] },
        { g: 'Ausbildung und Jugendliche', f: 'Mindestdauer der Probezeit in der Ausbildung', a: 1, e: 'Monat(e)', i: '§ 20 BBiG: mindestens 1, höchstens 4 Monate.' },
        { g: 'Arbeitszeit und Urlaub', f: 'Gesetzlicher Mindesturlaub nach BUrlG (6-Tage-Woche)', a: 24, e: 'Werktage', i: '§ 3 BUrlG: 24 Werktage. Bei einer 5-Tage-Woche entspricht das 20 Arbeitstagen.', t: [[20, '20 Tage sind es bei einer 5-Tage-Woche. Das Gesetz rechnet aber mit Werktagen (Montag bis Samstag): 24 Werktage.']] },
        { g: 'Ausbildung und Jugendliche', f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 16 sind', a: 30, e: 'Werktage', i: '§ 19 JArbSchG – maßgeblich ist das Alter zu Beginn des Kalenderjahres.' },
        { g: 'Ausbildung und Jugendliche', f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 17 sind', a: 27, e: 'Werktage', i: '§ 19 JArbSchG.' },
        { g: 'Ausbildung und Jugendliche', f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 18 sind', a: 25, e: 'Werktage', i: '§ 19 JArbSchG.' },
        { g: 'Betriebsrat', f: 'Mindestzahl ständiger wahlberechtigter Arbeitnehmer für einen Betriebsrat', a: 5, e: 'Arbeitnehmer', i: '§ 1 BetrVG: mindestens 5 ständige wahlberechtigte Arbeitnehmer, davon 3 wählbar.', t: [[10, 'Mehr als 10 Arbeitnehmer braucht es für das Kündigungsschutzgesetz – einen Betriebsrat gibt es schon ab 5.']] },
        { g: 'Betriebsrat', f: 'Mindestalter für das Wahlrecht bei der Betriebsratswahl', a: 16, e: 'Jahre', i: '§ 7 BetrVG (seit 2021). Wählbar in den Betriebsrat ist man ab 18.', t: [[18, '18 ist das Alter für die Wählbarkeit. Wählen darf man seit 2021 schon ab 16.']] },
        { g: 'Betriebsrat', f: 'Regelmäßige Amtszeit des Betriebsrats', a: 4, e: 'Jahre', i: '§ 21 BetrVG. Die Jugend- und Auszubildendenvertretung wird für 2 Jahre gewählt.' },
        { g: 'Mutterschutz, Elternzeit, Krankheit', f: 'Mutterschutzfrist vor der Entbindung', a: 6, e: 'Wochen', i: '§ 3 MuSchG: 6 Wochen vor, 8 Wochen nach der Geburt.', t: [[8, '8 Wochen gelten nach der Entbindung – davor sind es 6.']] },
        { g: 'Mutterschutz, Elternzeit, Krankheit', f: 'Mutterschutzfrist nach der Entbindung (Regelfall)', a: 8, e: 'Wochen', i: '§ 3 MuSchG: bei Früh- und Mehrlingsgeburten 12 Wochen.', t: [[6, '6 Wochen gelten vor der Entbindung – danach sind es 8.']] },
        { g: 'Mutterschutz, Elternzeit, Krankheit', f: 'Entgeltfortzahlung im Krankheitsfall durch den Arbeitgeber', a: 6, e: 'Wochen', i: '§ 3 EFZG: bis zu 6 Wochen je Krankheit, danach zahlt die Krankenkasse Krankengeld.' },
        { g: 'Kaufvertrag und Forderungen', f: 'Gesetzliche Mängelhaftung beim Kauf neuer Sachen', a: 2, e: 'Jahre', i: '§ 438 BGB. Bei gebrauchten Sachen kann sie gegenüber Verbrauchern auf 1 Jahr verkürzt werden.', t: [[3, '3 Jahre beträgt die regelmäßige Verjährung von Forderungen. Die Gewährleistung beim Kauf dauert 2 Jahre.']] },
        { g: 'Kaufvertrag und Forderungen', f: 'Widerrufsfrist bei Online-Käufen für Verbraucher', a: 14, e: 'Tage', i: '§ 355 BGB: 14 Tage ab Erhalt der Ware bei ordnungsgemäßer Belehrung.' },
        { g: 'Kaufvertrag und Forderungen', f: 'Regelmäßige Verjährungsfrist', a: 3, e: 'Jahre', i: '§ 195 BGB, Beginn mit dem Schluss des Jahres, in dem der Anspruch entstanden ist (§ 199 BGB).', t: [[2, '2 Jahre dauert die Gewährleistung beim Kauf. Die regelmäßige Verjährung beträgt 3 Jahre.']] },
        { g: 'Unternehmen', f: 'Mindeststammkapital einer GmbH', a: 25000, e: '€', i: '§ 5 GmbHG. Die UG (haftungsbeschränkt) geht schon ab 1 €.', t: [[50000, '50.000 € braucht die AG. Für die GmbH reichen 25.000 €.']] },
        { g: 'Unternehmen', f: 'Mindestgrundkapital einer AG', a: 50000, e: '€', i: '§ 7 AktG.', t: [[25000, '25.000 € braucht die GmbH. Die AG braucht 50.000 €.']] },
        { g: 'Kündigung', f: 'Kündigungsschutzgesetz: Betriebsgröße „mehr als …“', a: 10, e: 'Arbeitnehmer', i: '§ 23 KSchG: in Betrieben mit mehr als 10 Arbeitnehmern (Azubis zählen nicht mit).', t: [[5, '5 Arbeitnehmer reichen für einen Betriebsrat. Das KSchG gilt erst bei mehr als 10.']] },
        { g: 'Kündigung', f: 'Kündigungsschutzgesetz: Wartezeit', a: 6, e: 'Monate', i: '§ 1 KSchG: Das Arbeitsverhältnis muss länger als 6 Monate bestehen.' },
        { g: 'Kündigung', f: 'Frist für die Kündigungsschutzklage nach Zugang der Kündigung', a: 3, e: 'Wochen', i: '§ 4 KSchG – danach gilt die Kündigung als wirksam.' },
        { g: 'Kündigung', f: 'Frist für eine fristlose Kündigung ab Kenntnis des wichtigen Grundes', a: 2, e: 'Wochen', i: '§ 626 Abs. 2 BGB.' },
        { g: 'Ausbildung und Jugendliche', f: 'Höchstarbeitszeit für Jugendliche pro Woche', a: 40, e: 'Stunden', i: '§ 8 JArbSchG: 8 Stunden täglich, 40 Stunden wöchentlich.' },
        { g: 'Arbeitszeit und Urlaub', f: 'Regelmäßige Höchstarbeitszeit Erwachsener pro Werktag', a: 8, e: 'Stunden', i: '§ 3 ArbZG: bis zu 10 Stunden, wenn im Durchschnitt von 6 Monaten 8 Stunden nicht überschritten werden.', t: [[10, '10 Stunden sind nur ausnahmsweise erlaubt, wenn es einen Ausgleich gibt. Regelmäßig sind es 8.']] },
        { g: 'Arbeitszeit und Urlaub', f: 'Mindestruhezeit zwischen zwei Arbeitstagen (Erwachsene)', a: 11, e: 'Stunden', i: '§ 5 ArbZG (Jugendliche: 12 Stunden, § 13 JArbSchG).' },
        { g: 'Arbeitszeit und Urlaub', f: 'Pause bei mehr als 6 Stunden Arbeit (Erwachsene)', a: 30, e: 'Minuten', i: '§ 4 ArbZG: mehr als 6 Stunden → 30 Minuten, mehr als 9 Stunden → 45 Minuten.', t: [[60, '60 Minuten gelten für Jugendliche. Erwachsene brauchen nach mehr als 6 Stunden 30 Minuten Pause.']] },
        { g: 'Arbeitszeit und Urlaub', f: 'Pause bei mehr als 9 Stunden Arbeit (Erwachsene)', a: 45, e: 'Minuten', i: '§ 4 ArbZG.' },
        { g: 'Ausbildung und Jugendliche', f: 'Pause bei mehr als 6 Stunden Arbeit (Jugendliche)', a: 60, e: 'Minuten', i: '§ 11 JArbSchG: mehr als 4,5 bis 6 Stunden → 30 Minuten, mehr als 6 Stunden → 60 Minuten.', t: [[30, '30 Minuten gelten für Erwachsene (oder für Jugendliche bei 4,5 bis 6 Stunden). Ab mehr als 6 Stunden brauchen Jugendliche 60 Minuten.']] },
        { g: 'Arbeitszeit und Urlaub', f: 'Wartezeit bis zum vollen Urlaubsanspruch', a: 6, e: 'Monate', i: '§ 4 BUrlG. Vorher gibt es Teilurlaub (1/12 je vollem Monat).' },
        { g: 'Mutterschutz, Elternzeit, Krankheit', f: 'Maximale Elternzeit je Kind', a: 3, e: 'Jahre', i: '§ 15 BEEG – bis zum 3. Geburtstag, Teile davon auch später.' },
        { g: 'Mutterschutz, Elternzeit, Krankheit', f: 'Anmeldefrist für Elternzeit (bis zum 3. Geburtstag) vor Beginn', a: 7, e: 'Wochen', i: '§ 16 BEEG: schriftlich, 7 Wochen vor Beginn.' },
        { g: 'Kündigung', f: 'Grundkündigungsfrist nach § 622 Abs. 1 BGB', a: 4, e: 'Wochen', i: '4 Wochen zum 15. oder zum Ende eines Kalendermonats.' },
        { g: 'Kündigung', f: 'Kündigungsfrist während einer vereinbarten Probezeit im Arbeitsverhältnis', a: 2, e: 'Wochen', i: '§ 622 Abs. 3 BGB – zu jedem Tag, ohne festen Endtermin.' },
        { g: 'Kündigung', f: 'Längste Probezeit mit verkürzter Kündigungsfrist im Arbeitsverhältnis', a: 6, e: 'Monate', i: '§ 622 Abs. 3 BGB.', t: [[4, '4 Monate sind die Höchstgrenze in der Ausbildung. Im Arbeitsverhältnis sind es 6.']] },
        { g: 'Kaufvertrag und Forderungen', f: 'Widerspruchsfrist gegen einen Mahnbescheid', a: 2, e: 'Wochen', i: '§ 692 ZPO – danach kann der Gläubiger den Vollstreckungsbescheid beantragen.' },
        { g: 'Kaufvertrag und Forderungen', f: 'Beweislastumkehr beim Verbrauchsgüterkauf', a: 1, e: 'Jahr(e)', i: '§ 477 BGB (seit 2022; vorher 6 Monate).' }
    ];

    const naechstesFaktum = deck(FAKTEN);

    function faktenAufgabe(rng) {
        const auswahl = [];
        while (auswahl.length < 4) {
            const x = naechstesFaktum(rng);
            if (!auswahl.includes(x)) auswahl.push(x);
        }
        const fragen = auswahl.map((x) => ({
            label: x.f, answer: x.a, unit: x.e, info: x.i,
            typisch: (x.t || []).map(([wert, warum]) => ({ answer: wert, warum }))
        }));
        // eine berechnete Verjährungsfrage – das Jahr wird ohne Tausenderpunkt geschrieben
        const entstanden = zufallsDatum(rng, 2023, 2026);
        const y = entstanden.getUTCFullYear();
        fragen.push({
            label: `Eine Forderung entstand am ${de(entstanden)}. Die regelmäßige Verjährung endet mit Ablauf des 31.12. im Jahr …`,
            answer: y + 3, unit: '', jahr: true,
            info: `Entstanden ${de(entstanden)} → die Frist beginnt erst mit dem Schluss des Jahres (31.12.${y}) → plus 3 Jahre → Ablauf des 31.12.${y + 3} (§§ 195, 199 BGB).`,
            typisch: [
                { answer: y + 2, warum: 'Die regelmäßige Verjährung dauert 3 Jahre (2 Jahre sind die Gewährleistung beim Kauf).' },
                { answer: y + 4, warum: `Gezählt wird ab dem 31.12.${y}: drei Jahre später ist der 31.12.${y + 3}.` }
            ]
        });
        const felder = [];
        return {
            title: 'Zahlen und Fristen',
            description: 'Fünf schnelle Fragen – trage jeweils nur die Zahl ein.',
            hint: 'Merkhilfe: Probezeit Ausbildung 1–4 Monate, Arbeitsverhältnis höchstens 6 Monate. Verjährung 3 Jahre ab Jahresende, Gewährleistung 2 Jahre, Widerruf 14 Tage.',
            render(body) {
                fragen.forEach((q, i) => {
                    const id = 'wf-' + i;
                    const input = numberInput({ id, inputmode: 'numeric' });
                    felder.push({ input, answer: q.answer, typisch: q.typisch, q });
                    body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: id, style: 'flex:1 1 20rem' }, q.label), input, q.unit ? h('span', { class: 'game-unit', style: 'min-width:6rem' }, q.unit) : null));
                });
            },
            check() {
                const r = checkFields(felder);
                return { correct: r.correct, score: r.score, message: r.correct ? '' : `${r.right} von ${r.total} richtig.`, tipps: r.tipps };
            },
            showSolution(box) {
                felder.forEach((f) => { f.input.value = f.q.jahr ? dePlain(f.answer) : deFormat(f.answer, 0); mark(f.input, null); });
                box.append(h('h3', {}, 'Erklärungen'), h('ul', { class: 'game-steps' }, fragen.map((q) =>
                    h('li', {}, h('strong', {}, q.jahr ? `Verjährung: Ablauf des 31.12.${dePlain(q.answer)}` : `${q.label}: ${deFormat(q.answer, 0)} ${q.unit}`), ' – ' + q.info))));
            }
        };
    }

    // ---------- Kündigungsfristen ----------

    /** Verlängerte Fristen bei Kündigung durch den Arbeitgeber: [ab Jahren, Monate] (§ 622 Abs. 2 BGB) */
    const VERLAENGERT = [[20, 7], [15, 6], [12, 5], [10, 4], [8, 3], [5, 2], [2, 1]];
    const MONATE = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];

    const REGELN = [
        { id: 'sofort', text: 'keine Frist – endet mit dem Zugang' },
        { id: 'w2', text: '2 Wochen – zu jedem Tag' },
        { id: 'w4', text: '4 Wochen – zu jedem Tag' },
        { id: 'grund', text: '4 Wochen zum 15. oder zum Monatsende' }
    ].concat([1, 2, 3, 4, 5, 6, 7].map((m) => ({ id: 'm' + m, text: `${m} Monat${m === 1 ? '' : 'e'} zum Monatsende` })));

    const monateText = (m) => `${m} Monat${m === 1 ? '' : 'e'}`;
    const stufeFuer = (jahre) => VERLAENGERT.find(([j]) => jahre >= j);

    /** Nächster zulässiger Termin der Grundfrist: der 15. oder das Monatsende. */
    const zum15OderMonatsende = (dt) => (dt.getUTCDate() <= 15 ? datum(dt.getUTCFullYear(), dt.getUTCMonth() + 1, 15) : monatsende(dt));

    /** Grundfrist: 28 Tage ab dem Tag nach dem Zugang, dann zum nächsten 15. oder Monatsende. */
    function grundfrist(zugang) {
        const frist = plusTage(zugang, 28);
        return { frist, ende: zum15OderMonatsende(frist) };
    }

    /** Verlängerte Frist: n Monate ab Zugang, dann zum Monatsende. */
    const monatsfrist = (zugang, m) => {
        const frist = plusMonate(zugang, m);
        return { frist, ende: monatsende(frist) };
    };

    function grundSchritte(zugang) {
        const { frist, ende } = grundfrist(zugang);
        return [
            'Grundkündigungsfrist: <strong>4 Wochen zum 15. oder zum Ende eines Kalendermonats</strong> (§ 622 Abs. 1 BGB).',
            `Die 4 Wochen (28 Tage) zählen ab dem Tag nach dem Zugang: ${de(zugang)} + 28 Tage = ${deLang(frist)}.`,
            iso(frist) === iso(ende)
                ? `Das Fristende fällt genau auf ${frist.getUTCDate() === 15 ? 'den 15.' : 'ein Monatsende'} – ein zulässiger Termin: <strong>${deLang(ende)}</strong>.`
                : `Früher darf das Arbeitsverhältnis nicht enden. Nächster zulässiger Termin (15. oder Monatsende): <strong>${deLang(ende)}</strong>.`
        ];
    }

    function grundTypisch(zugang) {
        const { frist, ende } = grundfrist(zugang);
        const liste = [];
        if (iso(frist) !== iso(ende)) liste.push({ answer: frist, warum: 'Nach den 4 Wochen geht es noch bis zum nächsten zulässigen Termin weiter – dem 15. oder dem Monatsende.' });
        if (ende.getUTCDate() === 15) liste.push({ answer: monatsende(ende), warum: 'Endet die 4-Wochen-Frist spätestens am 15., ist schon der 15. ein zulässiger Termin – nicht erst das Monatsende.' });
        liste.push({ answer: zum15OderMonatsende(plusMonate(zugang, 1)), warum: '4 Wochen sind genau 28 Tage – nicht ein ganzer Monat.' });
        liste.push({ answer: plusTage(zugang, 14), warum: '2 Wochen gelten nur in einer vereinbarten Probezeit.' });
        return liste;
    }

    function monatsSchritte(zugang, jahre, m) {
        const { frist, ende } = monatsfrist(zugang, m);
        return [
            `Der Arbeitgeber kündigt nach ${jahre} Jahren Betriebszugehörigkeit: Stufe „ab ${stufeFuer(jahre)[0]} Jahren“ → <strong>${monateText(m)} zum Monatsende</strong> (§ 622 Abs. 2 BGB).`,
            `${monateText(m)} ab Zugang: ${de(zugang)} + ${monateText(m)} = ${deLang(frist)}.`,
            iso(frist) === iso(ende) ? `Das ist bereits ein Monatsende: <strong>${deLang(ende)}</strong>.` : `Weiter bis zum Monatsende: <strong>${deLang(ende)}</strong>.`
        ];
    }

    function monatsTypisch(zugang, jahre, m) {
        const { frist, ende } = monatsfrist(zugang, m);
        const liste = [{ answer: grundfrist(zugang).ende, warum: `Nach ${jahre} Jahren im Betrieb gilt bei einer Kündigung durch den Arbeitgeber nicht mehr die Grundfrist, sondern eine verlängerte Frist.` }];
        if (iso(frist) !== iso(ende)) liste.push({ answer: frist, warum: 'Nach Ablauf der Monate geht es noch bis zum Monatsende weiter.' });
        [m - 1, m + 1].filter((x) => x >= 1 && x <= 7).forEach((x) => liste.push({
            answer: monatsfrist(zugang, x).ende,
            warum: 'Prüfe die Stufe: ab 2 Jahren 1 Monat, ab 5 → 2, ab 8 → 3, ab 10 → 4, ab 12 → 5, ab 15 → 6, ab 20 Jahren 7 Monate.'
        }));
        return liste;
    }

    // Jeder Fall liefert: text, regel, frage ('ende' | 'zugang'), loesung, schritte, typisch, optional vertrag und merke

    function fallProbezeit(rng, zugang) {
        const eintritt = plusMonate(zugang, -rng.int(1, 5));
        const agKuendigt = rng.chance(0.5);
        const ende = plusTage(zugang, 14);
        return {
            text: `Mia ist seit dem ${de(eintritt)} als IT-Supporterin angestellt; im Arbeitsvertrag sind 6 Monate Probezeit vereinbart. ${agKuendigt ? 'Der Arbeitgeber kündigt ihr' : 'Sie kündigt selbst'} – die Kündigung geht am <strong>${deLang(zugang)}</strong> zu.`,
            regel: 'w2', frage: 'ende', loesung: ende,
            schritte: [
                `Die Kündigung geht in der vereinbarten Probezeit zu (sie läuft bis ${de(plusTage(plusMonate(eintritt, 6), -1))}). Dann gilt für beide Seiten eine Frist von <strong>2 Wochen – zu jedem beliebigen Tag</strong> (§ 622 Abs. 3 BGB).`,
                `Die 14 Tage zählen ab dem Tag nach dem Zugang: ${de(zugang)} + 14 Tage = <strong>${deLang(ende)}</strong> – derselbe Wochentag wie beim Zugang.`
            ],
            merke: 'In der Probezeit gibt es keinen festen Endtermin. Das Arbeitsverhältnis kann deshalb auch am 12. oder 23. eines Monats enden.',
            typisch: [
                { answer: grundfrist(zugang).ende, warum: 'Das wäre die Grundkündigungsfrist. In einer vereinbarten Probezeit gilt die kürzere Frist von 2 Wochen.' },
                { answer: plusTage(zugang, 13), warum: 'Die Frist beginnt erst am Tag <em>nach</em> dem Zugang – es müssen 14 volle Tage sein.' },
                { answer: monatsende(ende), warum: 'In der Probezeit wird nicht auf das Monatsende aufgerundet.' }
            ]
        };
    }

    function fallAzubiProbezeit(rng, zugang) {
        const probe = rng.pick([2, 3, 4]);
        const eintritt = plusTage(plusMonate(zugang, -rng.int(0, probe - 1)), -rng.int(3, 20));
        const betrieb = rng.chance(0.5);
        return {
            text: `Tim hat am ${de(eintritt)} seine Ausbildung zum Fachinformatiker begonnen; die Probezeit beträgt ${probe} Monate. ${betrieb ? 'Der Ausbildungsbetrieb kündigt ihm schriftlich' : 'Tim merkt, dass der Beruf nicht zu ihm passt, und kündigt schriftlich'}. Die Kündigung geht am <strong>${deLang(zugang)}</strong> zu.`,
            regel: 'sofort', frage: 'ende', loesung: zugang, vertrag: 'Ausbildungsverhältnis',
            schritte: [
                `Die Kündigung geht innerhalb der Probezeit zu (sie läuft bis ${de(plusTage(plusMonate(eintritt, probe), -1))}).`,
                'In der Probezeit können beide Seiten das Ausbildungsverhältnis <strong>jederzeit ohne Kündigungsfrist</strong> kündigen (§ 22 Abs. 1 BBiG). Ein Grund muss nicht genannt werden – die Schriftform aber ist Pflicht.',
                `Die Kündigung wirkt mit dem Zugang: Das Ausbildungsverhältnis endet am <strong>${deLang(zugang)}</strong>.`
            ],
            merke: 'Für die Ausbildung gilt das BBiG, nicht § 622 BGB: In der Probezeit gibt es gar keine Frist.',
            typisch: [
                { answer: plusTage(zugang, 14), warum: 'Die 2-Wochen-Frist gilt in der Probezeit eines <em>Arbeits</em>verhältnisses. In der Ausbildung gibt es während der Probezeit keine Frist.' },
                { answer: plusTage(zugang, 28), warum: '4 Wochen gelten erst nach der Probezeit – und nur, wenn der Azubi die Ausbildung aufgibt oder den Beruf wechselt.' },
                { answer: grundfrist(zugang).ende, warum: 'Die Grundkündigungsfrist aus dem BGB gilt hier nicht – die Ausbildung regelt das BBiG.' }
            ]
        };
    }

    function fallAzubiAufgabe(rng, zugang) {
        const eintritt = datum(zugang.getUTCFullYear() - rng.int(1, 2), rng.pick([8, 9]), 1);
        const ende = plusTage(zugang, 28);
        const plan = rng.pick(['ein Studium beginnen', 'eine Ausbildung zur Mediengestalterin anfangen', 'eine Ausbildung zur Elektronikerin anfangen', 'in den elterlichen Betrieb wechseln und Bäckerin werden']);
        return {
            text: `Lena ist seit dem ${de(eintritt)} in der Ausbildung, die Probezeit ist vorbei. Sie möchte die Ausbildung aufgeben und ${plan}. Ihre schriftliche Kündigung mit Angabe des Grundes geht dem Betrieb am <strong>${deLang(zugang)}</strong> zu.`,
            regel: 'w4', frage: 'ende', loesung: ende, vertrag: 'Ausbildungsverhältnis',
            schritte: [
                'Nach der Probezeit kann der Azubi mit einer Frist von <strong>4 Wochen</strong> kündigen, wenn er die Berufsausbildung aufgeben oder einen anderen Beruf lernen will (§ 22 Abs. 2 Nr. 2 BBiG). Die Kündigung muss schriftlich sein und den Grund nennen.',
                `Einen festen Endtermin gibt es nicht: ${de(zugang)} + 28 Tage = <strong>${deLang(ende)}</strong>.`,
                'Der Betrieb dagegen kann nach der Probezeit nur noch fristlos aus wichtigem Grund kündigen.'
            ],
            merke: '4 Wochen ohne festen Termin – nicht „zum 15. oder Monatsende“. Das Ende fällt auf denselben Wochentag wie der Zugang.',
            typisch: [
                { answer: grundfrist(zugang).ende, warum: 'Für Azubis gilt § 22 BBiG: 4 Wochen ohne festen Endtermin – es wird nicht auf den 15. oder das Monatsende aufgerundet.' },
                { answer: zugang, warum: 'Fristlos geht es nur in der Probezeit oder aus wichtigem Grund. Wer die Ausbildung aufgibt, hat 4 Wochen Frist.' },
                { answer: plusTage(zugang, 27), warum: 'Gezählt wird ab dem Tag nach dem Zugang – 28 volle Tage.' }
            ]
        };
    }

    function fallGrundAn(rng, zugang, lange) {
        const jahre = lange ? rng.int(3, 18) : rng.int(0, 1);
        const zeit = jahre === 0 ? `${rng.int(7, 11)} Monaten` : jahre === 1 ? 'einem Jahr' : `${jahre} Jahren`;
        const typisch = [];
        if (jahre >= 2) {
            const m = stufeFuer(jahre)[1];
            typisch.push({ answer: monatsfrist(zugang, m).ende, warum: 'Die verlängerte Frist gilt nur, wenn der Arbeitgeber kündigt. Kündigt der Arbeitnehmer, bleibt es bei 4 Wochen zum 15. oder Monatsende.' });
        }
        return {
            text: `Jonas arbeitet seit ${zeit} als Fachinformatiker in einem Systemhaus, die Probezeit ist vorbei. Im Arbeitsvertrag sind die gesetzlichen Kündigungsfristen vereinbart. Er hat ein besseres Angebot und kündigt selbst; die Kündigung geht dem Arbeitgeber am <strong>${deLang(zugang)}</strong> zu.`,
            regel: 'grund', frage: 'ende', loesung: grundfrist(zugang).ende, an: true,
            schritte: [jahre >= 2
                ? `Jonas ist zwar schon ${jahre} Jahre im Betrieb – aber er kündigt <strong>selbst</strong>. Die verlängerten Fristen nach § 622 Abs. 2 BGB gelten nur für Kündigungen durch den Arbeitgeber.`
                : 'Probezeit vorbei, nichts Besonderes vereinbart: Es gilt die gesetzliche Grundkündigungsfrist.'].concat(grundSchritte(zugang)),
            merke: jahre >= 2 ? 'Arbeitnehmer kündigen (ohne andere Vereinbarung) immer mit der Grundfrist – egal, wie lange sie schon im Betrieb sind.' : null,
            typisch: typisch.concat(grundTypisch(zugang))
        };
    }

    function fallGrundAg(rng, zugang) {
        const monate = rng.int(8, 22);
        return {
            text: `Frau Schulz ist seit ${monate} Monaten bei einem IT-Dienstleister beschäftigt, die Probezeit ist vorbei. Der Arbeitgeber kündigt ihr ordentlich; die Kündigung geht am <strong>${deLang(zugang)}</strong> zu. Vertraglich gelten die gesetzlichen Fristen.`,
            regel: 'grund', frage: 'ende', loesung: grundfrist(zugang).ende,
            schritte: [`Betriebszugehörigkeit: ${monate} Monate – weniger als 2 Jahre. Die verlängerten Fristen beginnen erst ab 2 Jahren; es gilt die Grundkündigungsfrist.`].concat(grundSchritte(zugang)),
            typisch: [{ answer: monatsfrist(zugang, 1).ende, warum: '„1 Monat zum Monatsende“ gilt erst ab 2 Jahren Betriebszugehörigkeit.' }].concat(grundTypisch(zugang))
        };
    }

    function fallLang(rng, zugang, mitEintritt) {
        let jahre = rng.int(2, 22);
        let eintritt = null;
        if (mitEintritt) {
            eintritt = datum(zugang.getUTCFullYear() - rng.int(1, 22), rng.int(1, 12), 1 + rng.int(0, 27));
            if (volleJahre(eintritt, zugang) < 1) eintritt = datum(eintritt.getUTCFullYear() - 1, eintritt.getUTCMonth() + 1, eintritt.getUTCDate());
            jahre = volleJahre(eintritt, zugang);
        }
        const text = (mitEintritt ? `Herr Kaya ist seit dem <strong>${de(eintritt)}</strong> im Unternehmen.` : `Herr Kaya ist seit <strong>${jahre} Jahren</strong> im Unternehmen.`) +
            ` Der Arbeitgeber kündigt ihm ordentlich (betriebsbedingt); die Kündigung geht am <strong>${deLang(zugang)}</strong> zu. Vertraglich gelten die gesetzlichen Fristen.`;
        const schritte = mitEintritt ? [`Betriebszugehörigkeit beim Zugang der Kündigung: ${de(eintritt)} bis ${de(zugang)} = <strong>${jahre} volle${jahre === 1 ? 's Jahr' : ' Jahre'}</strong>.`] : [];
        const typisch = [];
        if (mitEintritt) {
            const differenz = zugang.getUTCFullYear() - eintritt.getUTCFullYear();
            const falscheStufe = stufeFuer(differenz);
            if (differenz !== jahre && falscheStufe && falscheStufe !== stufeFuer(jahre)) {
                typisch.push({ answer: monatsfrist(zugang, falscheStufe[1]).ende, warum: 'Zähle nur volle Beschäftigungsjahre bis zum Zugang der Kündigung – nicht die Differenz der Jahreszahlen.' });
            }
        }
        const stufe = stufeFuer(jahre);
        if (!stufe) {
            return {
                text, regel: 'grund', frage: 'ende', loesung: grundfrist(zugang).ende,
                schritte: schritte.concat('Weniger als 2 volle Jahre: Die verlängerten Fristen greifen noch nicht, es gilt die Grundkündigungsfrist.', grundSchritte(zugang)),
                typisch: typisch.concat({ answer: monatsfrist(zugang, 1).ende, warum: '„1 Monat zum Monatsende“ gilt erst ab 2 <em>vollen</em> Jahren Betriebszugehörigkeit.' }, grundTypisch(zugang))
            };
        }
        const m = stufe[1];
        return {
            text, regel: 'm' + m, frage: 'ende', loesung: monatsfrist(zugang, m).ende,
            schritte: schritte.concat(monatsSchritte(zugang, jahre, m)),
            typisch: typisch.concat(monatsTypisch(zugang, jahre, m))
        };
    }

    function fallRueckGrund(rng, jahr) {
        const mon = rng.int(1, 12);
        const zum15 = rng.chance(0.4);
        const termin = datum(jahr, mon, zum15 ? 15 : tageImMonat(jahr, mon));
        const zugang = plusTage(termin, -28);
        const an = rng.chance(0.6);
        const zuSpaet = grundfrist(plusTage(zugang, 1)).ende;
        return {
            text: an
                ? `Sara arbeitet seit ${rng.int(3, 12)} Jahren als Systemadministratorin. Sie hat einen neuen Job und möchte ihr Arbeitsverhältnis zum <strong>${de(termin)}</strong> beenden; vereinbart sind die gesetzlichen Fristen. Bis wann muss ihre Kündigung dem Arbeitgeber spätestens zugehen?`
                : `Ein Arbeitgeber möchte einem Mitarbeiter, der seit ${rng.int(8, 20)} Monaten im Betrieb ist (Probezeit vorbei), zum <strong>${de(termin)}</strong> kündigen. Bis wann muss die Kündigung dem Mitarbeiter spätestens zugehen?`,
            regel: 'grund', frage: 'zugang', loesung: zugang, termin, an,
            schritte: [
                an ? 'Sara kündigt selbst – es gilt die Grundkündigungsfrist, egal wie lange sie schon im Betrieb ist.' : 'Weniger als 2 Jahre Betriebszugehörigkeit: Es gilt die Grundkündigungsfrist.',
                `Der ${de(termin)} ist ${zum15 ? 'ein 15.' : 'ein Monatsende'} und damit ein zulässiger Termin für die Grundfrist (4 Wochen zum 15. oder Monatsende).`,
                `Vom Wunschtermin 4 Wochen = 28 Tage zurückrechnen: ${de(termin)} − 28 Tage = <strong>${deLang(zugang)}</strong>.`,
                `Probe: ${de(zugang)} + 28 Tage = ${de(termin)} ✓. Geht die Kündigung einen Tag später zu, ist erst der ${de(zuSpaet)} möglich.`
            ],
            merke: 'Rückwärts rechnen heißt: Termin minus 28 Tage – nicht minus einen Monat. Zur Probe muss Zugang + 28 Tage genau den Termin ergeben.',
            typisch: [
                { answer: plusMonate(termin, -1), warum: '4 Wochen sind genau 28 Tage – nicht ein Monat. Rechne 28 Tage zurück.' },
                { answer: plusTage(termin, -27), warum: 'Die Frist beginnt am Tag nach dem Zugang. Damit 28 volle Tage bis zum Termin bleiben, muss die Kündigung 28 Tage vorher zugehen.' },
                { answer: plusTage(termin, -29), warum: 'Das würde auch reichen – gefragt ist aber der <em>späteste</em> Tag. Probe: Zugang + 28 Tage muss genau den Termin ergeben.' },
                { answer: plusTage(termin, -14), warum: '2 Wochen gelten nur in der Probezeit.' }
            ]
        };
    }

    function fallRueckLang(rng, jahr) {
        const jahre = rng.int(2, 22);
        const [ab, m] = stufeFuer(jahre);
        const mon = rng.int(1, 12);
        const termin = datum(jahr, mon, tageImMonat(jahr, mon));
        const zugang = monatsende(plusMonate(datum(jahr, mon, 1), -m));
        const naechster = plusTage(zugang, 1);
        const typisch = [{ answer: plusTage(termin, -28), warum: 'Das wäre die Rechnung mit der Grundfrist. Kündigt der Arbeitgeber nach mindestens 2 Jahren, gilt eine verlängerte Frist.' }];
        if (iso(plusMonate(termin, -m)) !== iso(zugang)) {
            typisch.push({ answer: plusMonate(termin, -m), warum: 'Bei „zum Monatsende“ reicht der Zugang am <em>letzten Tag</em> des Monats, der so viele Monate vor dem Termin liegt.' });
        }
        [m - 1, m + 1].filter((x) => x >= 1 && x <= 7).forEach((x) => typisch.push({
            answer: monatsende(plusMonate(datum(jahr, mon, 1), -x)),
            warum: 'Prüfe die Stufe: ab 2 Jahren 1 Monat, ab 5 → 2, ab 8 → 3, ab 10 → 4, ab 12 → 5, ab 15 → 6, ab 20 Jahren 7 Monate.'
        }));
        return {
            text: `Eine Mitarbeiterin ist seit ${jahre} Jahren im Unternehmen. Wegen einer Umstrukturierung will der Arbeitgeber ihr Arbeitsverhältnis zum <strong>${de(termin)}</strong> ordentlich kündigen; es gelten die gesetzlichen Fristen. Bis wann muss ihr die Kündigung spätestens zugehen?`,
            regel: 'm' + m, frage: 'zugang', loesung: zugang, termin,
            schritte: [
                `Kündigung durch den Arbeitgeber nach ${jahre} Jahren: Stufe „ab ${ab} Jahren“ → <strong>${monateText(m)} zum Monatsende</strong> (§ 622 Abs. 2 BGB).`,
                `Bis zum ${de(termin)} müssen ${monateText(m)} vergangen sein. Also ${monateText(m)} zurückrechnen: Die Kündigung muss spätestens am letzten Tag im ${MONATE[zugang.getUTCMonth()]} zugehen – <strong>${deLang(zugang)}</strong>.`,
                `Probe: ${de(zugang)} + ${monateText(m)} = ${de(plusMonate(zugang, m))} → Monatsende ${de(termin)} ✓. Ein Tag später (${de(naechster)}) wäre erst der ${de(monatsfrist(naechster, m).ende)} möglich.`
            ],
            merke: `„${monateText(m)} zum Monatsende“ heißt rückwärts: Zugang spätestens am letzten Tag des Monats, der ${monateText(m)} vor dem Ende liegt.`,
            typisch
        };
    }

    /** Postweg: Datum des Schreibens und Zugang fallen auseinander – gezählt wird ab Zugang. */
    function fallPost(rng) {
        const lange = rng.chance(0.5);
        const jahre = lange ? rng.int(2, 22) : 0;
        const m = lange ? stufeFuer(jahre)[1] : 0;
        const ergebnis = (z) => (lange ? monatsfrist(z, m).ende : grundfrist(z).ende);
        let zugang;
        let geschrieben;
        for (let versuch = 0; versuch < 60; versuch++) {
            zugang = zugangsTag(rng);
            geschrieben = plusTage(zugang, -rng.int(2, 4));
            if (iso(ergebnis(geschrieben)) !== iso(ergebnis(zugang))) break;   // die Falle soll greifen
        }
        const ende = ergebnis(zugang);
        return {
            text: `Ein Arbeitgeber kündigt Frau Öztürk, die seit ${lange ? jahre + ' Jahren' : rng.int(9, 20) + ' Monaten'} im Betrieb ist, ordentlich. Das Kündigungsschreiben ist auf <strong>${deLang(geschrieben)}</strong> datiert und wird per Post verschickt. Es liegt am <strong>${deLang(zugang)}</strong> in ihrem Briefkasten. Vertraglich gelten die gesetzlichen Fristen.`,
            regel: lange ? 'm' + m : 'grund', frage: 'ende', loesung: ende,
            schritte: [
                'Maßgeblich ist der <strong>Zugang</strong> – der Tag, an dem das Schreiben im Briefkasten liegt und man es normalerweise lesen kann (§ 130 BGB). Das Datum auf dem Schreiben spielt keine Rolle.'
            ].concat(lange ? monatsSchritte(zugang, jahre, m) : ['Weniger als 2 Jahre im Betrieb: Grundkündigungsfrist.'].concat(grundSchritte(zugang))),
            merke: 'Die Frist läuft ab Zugang. Wer knapp vor einem Termin kündigt, sollte die Kündigung deshalb persönlich übergeben (mit Zeugen) oder durch einen Boten einwerfen lassen.',
            typisch: [{ answer: ergebnis(geschrieben), warum: 'Gerechnet wird ab dem Zugang (Briefkasten), nicht ab dem Datum des Schreibens.' }]
                .concat(lange ? monatsTypisch(zugang, jahre, m) : grundTypisch(zugang))
        };
    }

    /** Hinweis, wenn die gewählte Frist nicht passt. */
    function regelTipp(gewaehlt, fall) {
        const soll = fall.regel;
        if (soll === 'grund' && gewaehlt.startsWith('m')) {
            return fall.an ? 'Die verlängerten Fristen gelten nur, wenn der <em>Arbeitgeber</em> kündigt. Kündigt der Arbeitnehmer, bleibt es bei der Grundfrist.' : 'Die verlängerten Fristen beginnen erst nach 2 vollen Jahren Betriebszugehörigkeit.';
        }
        if (soll.startsWith('m') && gewaehlt === 'grund') return 'Der Arbeitgeber kündigt nach mindestens 2 Jahren – dann gilt eine verlängerte Frist zum Monatsende.';
        if (soll.startsWith('m') && gewaehlt.startsWith('m')) return 'Die Richtung stimmt, aber nicht die Stufe: ab 2 Jahren 1 Monat, ab 5 → 2, ab 8 → 3, ab 10 → 4, ab 12 → 5, ab 15 → 6, ab 20 Jahren 7 Monate.';
        if (soll === 'w2') return 'Während einer vereinbarten Probezeit (höchstens 6 Monate) gilt eine verkürzte Frist von 2 Wochen.';
        if (soll === 'sofort') return 'In der Probezeit der Ausbildung muss keine Seite eine Frist einhalten (§ 22 Abs. 1 BBiG).';
        if (soll === 'w4') return 'Azubis, die nach der Probezeit die Ausbildung aufgeben, kündigen mit 4 Wochen Frist – ohne festen Endtermin (§ 22 Abs. 2 BBiG).';
        return 'Probezeit vorbei, keine Ausbildung: Es gilt § 622 BGB.';
    }

    const FALLTYPEN = {
        1: ['grund-an', 'grund-ag', 'probe', 'azubi-probe'],
        2: ['lang', 'grund-an-lang', 'azubi-aufgabe', 'rueck-grund', 'probe'],
        3: ['lang-eintritt', 'lang-eintritt', 'rueck-lang', 'post', 'rueck-grund', 'azubi-aufgabe']
    };

    /** Zugangstag einer Kündigung – nie an einem Sonntag, an dem keine Post kommt. */
    function zugangsTag(rng) {
        const dt = zufallsDatum(rng, 2026, 2027);
        return dt.getUTCDay() === 0 ? plusTage(dt, 1) : dt;
    }

    function kuendigungsFall(rng, typ) {
        const zugang = zugangsTag(rng);
        const jahr = rng.int(2026, 2027);
        return {
            'grund-an': () => fallGrundAn(rng, zugang, false),
            'grund-an-lang': () => fallGrundAn(rng, zugang, true),
            'grund-ag': () => fallGrundAg(rng, zugang),
            'probe': () => fallProbezeit(rng, zugang),
            'azubi-probe': () => fallAzubiProbezeit(rng, zugang),
            'azubi-aufgabe': () => fallAzubiAufgabe(rng, zugang),
            'lang': () => fallLang(rng, zugang, false),
            'lang-eintritt': () => fallLang(rng, zugang, true),
            'rueck-grund': () => fallRueckGrund(rng, jahr),
            'rueck-lang': () => fallRueckLang(rng, jahr),
            'post': () => fallPost(rng)
        }[typ]();
    }

    function kuendigungsAufgabe(rng, level) {
        const fall = kuendigungsFall(rng, rng.pick(FALLTYPEN[level]));
        const vertrag = fall.vertrag || 'Arbeitsverhältnis';
        const rueckwaerts = fall.frage === 'zugang';
        let fRegel;
        let fDatum;
        return {
            title: rueckwaerts ? 'Spätester Kündigungstermin' : 'Kündigungsfrist berechnen',
            description: rueckwaerts
                ? 'Welche Frist gilt – und an welchem Tag muss die Kündigung spätestens zugehen? Wochenenden und Feiertage spielen keine Rolle.'
                : `Welche Frist gilt – und an welchem Tag endet das ${vertrag} frühestens? Wochenenden und Feiertage spielen keine Rolle.`,
            hint: 'Erst klären: Ausbildung oder Arbeitsverhältnis? Probezeit? Wer kündigt? Danach: Frist ab dem Tag nach dem Zugang zählen und auf den nächsten zulässigen Termin aufrunden.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html: fall.text }));
                fRegel = h('select', { id: 'wk-regel', class: 'form-select form-select-sm', style: 'max-width:22rem' },
                    h('option', { value: '' }, 'bitte wählen'), REGELN.map((r) => h('option', { value: r.id }, r.text)));
                fDatum = h('input', { type: 'date', id: 'wk-datum', class: 'form-control form-control-sm game-num', style: 'max-width:12rem' });
                fRegel.addEventListener('change', () => mark(fRegel, null));
                fDatum.addEventListener('input', () => mark(fDatum, null));
                body.append(
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'wk-regel' }, 'Welche Frist gilt?'), fRegel),
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'wk-datum' }, rueckwaerts ? 'Spätester Zugang der Kündigung' : `Letzter Tag des ${vertrag}ses`), fDatum)
                );
            },
            check() {
                if (!fRegel.value && !fDatum.value) return { correct: false, score: 0, message: 'Bitte die Frist auswählen und ein Datum eingeben.' };
                const okR = fRegel.value === fall.regel;
                const okD = fDatum.value === iso(fall.loesung);
                mark(fRegel, fRegel.value ? okR : false);
                mark(fDatum, fDatum.value ? okD : false);
                const tipps = [];
                if (fRegel.value && !okR) tipps.push(regelTipp(fRegel.value, fall));
                if (fDatum.value && !okD) {
                    const t = fall.typisch.find((x) => iso(x.answer) === fDatum.value);
                    tipps.push(t ? t.warum : rueckwaerts
                        ? 'Mach die Probe: Zugang + Frist muss genau auf den gewünschten Termin führen.'
                        : 'Zähle die Frist ab dem Tag nach dem Zugang und runde dann – falls die Frist einen festen Termin hat – auf den nächsten zulässigen Termin auf.');
                }
                const fertig = okR && okD;
                return {
                    correct: fertig, score: (okR + okD) / 2, tipps: [...new Set(tipps)],
                    message: fertig ? (rueckwaerts ? `Spätester Zugang: ${deLang(fall.loesung)}.` : `Das ${vertrag} endet am ${deLang(fall.loesung)}.`) : ''
                };
            },
            showSolution(box) {
                fRegel.value = fall.regel;
                fDatum.value = iso(fall.loesung);
                mark(fRegel, null);
                mark(fDatum, null);
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, fall.schritte.map((s) => h('li', { html: s }))));
                if (fall.merke) box.append(h('p', { class: 'game-merke mb-0' }, fall.merke));
            }
        };
    }

    // ---------- Urlaubsanspruch ----------

    function urlaubsAufgabe(rng, level) {
        const jahr = rng.int(2025, 2028);
        if (level === 3) {
            const jahresurlaub = rng.pick([24, 25, 26, 28, 30]);
            const kandidaten = [];
            for (let m = 2; m <= 12; m++) {
                const monate = 13 - m;
                const rest = (jahresurlaub * monate) % 12;
                if (m <= 7 || rest === 0 || rest >= 6) kandidaten.push(m);
            }
            const m = rng.pick(kandidaten);
            const eintritt = datum(jahr, m, 1);
            const voll = m <= 7;
            const monate = 13 - m;
            const roh = jahresurlaub * monate / 12;
            const anspruch = voll ? jahresurlaub : (roh % 1 === 0 ? roh : Math.ceil(roh));
            const wartezeitEnde = plusTage(plusMonate(eintritt, 6), -1);
            const typisch = voll
                ? [{ answer: Math.ceil(roh - 0.5 + 1e-9), warum: 'Die 6 Monate Wartezeit enden noch im Eintrittsjahr – dann gibt es den vollen Jahresurlaub, keinen Teilurlaub.' }]
                : [
                    { answer: jahresurlaub, warum: 'Die Wartezeit endet erst im nächsten Jahr. Für das Eintrittsjahr gibt es deshalb nur Teilurlaub: 1/12 je vollem Monat.' },
                    { answer: Math.floor(roh), warum: 'Bruchteile von mindestens einem halben Tag werden auf einen vollen Tag aufgerundet (§ 5 Abs. 2 BUrlG).' },
                    { answer: Math.ceil(jahresurlaub * (monate - 1) / 12 - 0.5 + 1e-9), warum: `Zähle die vollen Monate von ${MONATE[m - 1]} bis Dezember – der Eintrittsmonat zählt mit: ${monate} Monate.` }
                ];
            return einfacheUrlaubsAufgabe({
                typisch,
                text: `Sophie beginnt am <strong>${de(eintritt)}</strong> bei einem neuen Arbeitgeber (5-Tage-Woche). Laut Vertrag hat sie <strong>${jahresurlaub} Arbeitstage</strong> Urlaub im Jahr; für das Eintrittsjahr regelt der Vertrag nichts Besonderes. Wie viele Urlaubstage stehen ihr für ${jahr} zu?`,
                answer: anspruch,
                unit: 'Arbeitstage',
                schritte: [
                    `Der volle Urlaubsanspruch entsteht erst nach sechs Monaten Wartezeit (§ 4 BUrlG): ${de(eintritt)} bis ${de(wartezeitEnde)}.`,
                    voll ? `Die Wartezeit endet noch ${jahr} → voller Jahresurlaub: <strong>${anspruch} Tage</strong>.`
                        : `Die Wartezeit endet erst ${wartezeitEnde.getUTCFullYear()} → für ${jahr} nur Teilurlaub: 1/12 je vollem Monat (§ 5 BUrlG).`,
                    voll ? 'Häufiger Fehler: anteilig rechnen, obwohl die Wartezeit im selben Jahr erfüllt wird.'
                        : `${jahresurlaub} · ${monate}/12 = ${deFormat(roh, 2)}` + (roh % 1 === 0 ? '' : ' → Bruchteile ab einem halben Tag werden aufgerundet') + ` → <strong>${anspruch} Tage</strong>.`
                ]
            });
        }
        const alterZuJahresbeginn = rng.pick(level === 1 ? [14, 15, 16, 17, 18, 21] : [15, 16, 17, 19, 25]);
        const geburt = datum(jahr - alterZuJahresbeginn - 1, rng.int(1, 12), 2 + rng.int(0, 26));
        const werktage = alterZuJahresbeginn < 16 ? 30 : alterZuJahresbeginn < 17 ? 27 : alterZuJahresbeginn < 18 ? 25 : 24;
        const gesetz = alterZuJahresbeginn < 18 ? 'JArbSchG § 19' : 'BUrlG § 3';
        const werktageFuer = (alter) => (alter < 16 ? 30 : alter < 17 ? 27 : alter < 18 ? 25 : 24);
        const alterTypisch = (umrechnen) => {
            const liste = [];
            const spaeter = werktageFuer(alterZuJahresbeginn + 1);
            if (spaeter !== werktage) liste.push({ answer: umrechnen(spaeter), warum: `Maßgeblich ist das Alter zu Beginn des Kalenderjahres: Am 01.01.${jahr} ist die Person noch ${alterZuJahresbeginn} – der Geburtstag im Lauf des Jahres zählt erst im nächsten Jahr.` });
            if (alterZuJahresbeginn < 18) liste.push({ answer: umrechnen(24), warum: 'Für Jugendliche gilt das JArbSchG – es gibt mehr Urlaub als die 24 Werktage des BUrlG.' });
            return liste;
        };
        if (level === 1) {
            return einfacheUrlaubsAufgabe({
                typisch: alterTypisch((w) => w),
                text: `Ein Azubi wurde am <strong>${de(geburt)}</strong> geboren. Wie viele Werktage gesetzlichen Mindesturlaub hat er im Jahr <strong>${jahr}</strong> (6-Tage-Woche)?`,
                answer: werktage,
                unit: 'Werktage',
                schritte: [
                    `Maßgeblich ist das Alter zu Beginn des Kalenderjahres: Am 01.01.${jahr} ist er ${alterZuJahresbeginn} Jahre alt.`,
                    alterZuJahresbeginn < 18 ? 'JArbSchG § 19: noch nicht 16 → 30, noch nicht 17 → 27, noch nicht 18 → 25 Werktage.' : 'Volljährig: Mindesturlaub nach BUrlG 24 Werktage.',
                    `Ergebnis: <strong>${werktage} Werktage</strong> (${gesetz}).`
                ]
            });
        }
        const tage = rng.pick([4, 5, 5]);
        const arbeitstage = werktage * tage / 6;
        const typisch = [{ answer: werktage, warum: `${werktage} sind Werktage (6-Tage-Woche). Umrechnen auf ${tage} Arbeitstage: Werktage · ${tage} / 6.` }]
            .concat(alterTypisch((w) => Math.round(w * tage / 6 * 100) / 100));
        if (arbeitstage % 1) typisch.push({ answer: Math.round(arbeitstage), warum: 'Beim vollen Jahresurlaub wird nicht gerundet – trag den genauen Wert mit Komma ein. Aufgerundet wird nur beim Teilurlaub.' });
        return einfacheUrlaubsAufgabe({
            typisch,
            text: `Geburtsdatum <strong>${de(geburt)}</strong>, Jahr <strong>${jahr}</strong>. Gearbeitet wird an <strong>${tage} Tagen pro Woche</strong>. Wie viele Arbeitstage beträgt der gesetzliche Mindesturlaub?`,
            answer: Math.round(arbeitstage * 100) / 100,
            decimals: 2,
            unit: 'Arbeitstage',
            schritte: [
                `Alter am 01.01.${jahr}: ${alterZuJahresbeginn} Jahre → <strong>${werktage} Werktage</strong> (${gesetz}).`,
                `Werktage beziehen sich auf eine 6-Tage-Woche (Mo–Sa). Umrechnung: ${werktage} · ${tage} / 6 = <strong>${deFormat(arbeitstage, 2)} Arbeitstage</strong>.`,
                arbeitstage % 1 ? 'Bruchteile werden beim vollen Jahresurlaub nicht gerundet – sie werden stundenweise gewährt.' : 'Das Ergebnis ist eine ganze Zahl.'
            ]
        });
    }

    function einfacheUrlaubsAufgabe(cfg) {
        let input;
        return {
            title: 'Urlaubsanspruch',
            description: 'Gesetzlicher bzw. vertraglicher Urlaub nach BUrlG und JArbSchG.',
            hint: 'Jugendliche: Alter zu Beginn des Kalenderjahres zählt. Werktage = 6-Tage-Woche, Umrechnung: Werktage · Arbeitstage pro Woche / 6. Voller Anspruch erst nach 6 Monaten Wartezeit.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html: cfg.text }));
                input = numberInput({ id: 'wu-tage' });
                body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'wu-tage' }, 'Urlaubsanspruch'), input, h('span', { class: 'game-unit' }, cfg.unit)));
            },
            check() {
                const r = checkFields([{ input, answer: cfg.answer, tolerance: cfg.decimals ? 0.01 : 0, typisch: cfg.typisch }]);
                return { correct: r.correct, score: r.score, message: '', tipps: r.tipps };
            },
            showSolution(box) {
                input.value = deFormat(cfg.answer, cfg.decimals || 0);
                mark(input, null);
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, cfg.schritte.map((s) => h('li', { html: s }))));
            }
        };
    }

    // ---------- Sozialversicherung ----------

    function svAufgabe(rng, level) {
        const brutto = rng.int(22, 55) * 100 + rng.pick([0, 25, 50, 80]);
        const zusatz = rng.pick([2.5, 2.7, 2.9, 3.1]);
        const kinderlos = rng.chance(0.5);
        const saetze = {
            kv: { name: 'Krankenversicherung', gesamt: 14.6 + zusatz, an: (14.6 + zusatz) / 2, info: `14,6 % + ${deFormat(zusatz, 1)} % Zusatzbeitrag, je zur Hälfte` },
            pv: { name: 'Pflegeversicherung', gesamt: 3.6, an: 1.8 + (kinderlos ? 0.6 : 0), info: '3,6 %, je zur Hälfte' + (kinderlos ? '; Kinderlosenzuschlag 0,6 % trägt der Arbeitnehmer allein' : '') },
            rv: { name: 'Rentenversicherung', gesamt: 18.6, an: 9.3, info: '18,6 %, je zur Hälfte' },
            av: { name: 'Arbeitslosenversicherung', gesamt: 2.6, an: 1.3, info: '2,6 %, je zur Hälfte' }
        };
        const zweige = level === 1 ? ['rv', 'av'] : ['kv', 'pv', 'rv', 'av'];
        const betraege = zweige.map((k) => ({ k, betrag: r2(brutto * saetze[k].an / 100) }));
        const summe = r2(betraege.reduce((s, b) => s + b.betrag, 0));
        const lohnsteuer = level === 3 ? r2(brutto * rng.pick([0.08, 0.1, 0.12, 0.14])) : 0;
        const kistSatz = level === 3 ? rng.pick([0, 8, 9]) : 0;
        const kist = r2(lohnsteuer * kistSatz / 100);
        const netto = r2(brutto - summe - lohnsteuer - kist);
        const halb = 'Der Arbeitnehmer zahlt nur seinen Anteil – die Hälfte des Beitragssatzes. Die andere Hälfte trägt der Arbeitgeber.';
        const typischFuer = {
            kv: [{ answer: r2(brutto * saetze.kv.gesamt / 100), warum: halb }, { answer: r2(brutto * 7.3 / 100), warum: 'Auch der Zusatzbeitrag der Krankenkasse wird je zur Hälfte geteilt – er gehört mit in den Arbeitnehmeranteil.' }],
            pv: kinderlos
                ? [{ answer: r2(brutto * 1.8 / 100), warum: 'Kinderlose ab 23 zahlen zusätzlich den Zuschlag von 0,6 % – allein, ohne Arbeitgeberanteil.' },
                    { answer: r2(brutto * 2.1 / 100), warum: 'Den Kinderlosenzuschlag trägt der Arbeitnehmer allein – er wird nicht geteilt.' },
                    { answer: r2(brutto * 4.2 / 100), warum: halb }]
                : [{ answer: r2(brutto * 2.4 / 100), warum: 'Der Zuschlag von 0,6 % gilt nur für Kinderlose.' }, { answer: r2(brutto * 3.6 / 100), warum: halb }],
            rv: [{ answer: r2(brutto * 18.6 / 100), warum: halb }],
            av: [{ answer: r2(brutto * 2.6 / 100), warum: halb }]
        };
        const felder = betraege.map((b) => ({ label: `AN-Anteil ${saetze[b.k].name}`, answer: b.betrag, typisch: typischFuer[b.k] }));
        felder.push({ label: 'AN-Anteile gesamt', answer: summe });
        if (level === 3) {
            felder.push({
                label: 'Nettogehalt', answer: netto,
                typisch: [{ answer: r2(brutto - summe), warum: 'Vom Brutto gehen neben den Sozialversicherungsbeiträgen auch Lohnsteuer und gegebenenfalls Kirchensteuer ab.' },
                    { answer: r2(brutto - summe - lohnsteuer), warum: 'Die Kirchensteuer (Prozentsatz der Lohnsteuer) fehlt noch.' }]
            });
        }
        const inputs = [];
        return {
            title: 'Sozialversicherungsbeiträge',
            description: 'Rechne mit den angegebenen Beitragssätzen (Beispielwerte, Bruttogehalt unter den Beitragsbemessungsgrenzen). Jeden Beitrag auf Cent runden.',
            hint: 'Arbeitnehmeranteil = Brutto · halber Beitragssatz. Ausnahmen: Zusatzbeitrag der KV wird ebenfalls geteilt, der Kinderlosenzuschlag zur Pflegeversicherung nicht.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html:
                    `Bruttogehalt: <strong>${eur(brutto)}</strong> im Monat, ${kinderlos ? 'kinderlos, 27 Jahre' : 'ein Kind'}.<br>` +
                    zweige.map((k) => `${saetze[k].name}: ${saetze[k].info}`).join('<br>') +
                    (level === 3 ? `<br>Lohnsteuer laut Tabelle: <strong>${eur(lohnsteuer)}</strong>, Kirchensteuer: ${kistSatz ? kistSatz + ' % der Lohnsteuer' : 'keine (kein Kirchenmitglied)'}, kein Solidaritätszuschlag.` : '') }));
                felder.forEach((f, i) => {
                    const input = numberInput({ id: 'sv-' + i });
                    inputs.push({ input, answer: f.answer, tolerance: 0.011, typisch: f.typisch });
                    body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'sv-' + i }, f.label), input, h('span', { class: 'game-unit' }, '€')));
                });
            },
            check() {
                const r = checkFields(inputs);
                return { correct: r.correct, score: r.score, message: r.correct ? (level === 1 ? 'Die übrigen Zweige (KV, PV) folgen auf Stufe Mittel.' : '') : '', tipps: r.tipps };
            },
            showSolution(box) {
                inputs.forEach((f) => { f.input.value = deFormat(f.answer, 2); mark(f.input, null); });
                const schritte = betraege.map((b) => `${saetze[b.k].name}: ${eur(brutto)} · ${deFormat(saetze[b.k].an, 2)} % = <strong>${eur(b.betrag)}</strong>`);
                schritte.push(`Summe Arbeitnehmeranteile: <strong>${eur(summe)}</strong>`);
                if (level === 3) {
                    if (kistSatz) schritte.push(`Kirchensteuer: ${eur(lohnsteuer)} · ${kistSatz} % = ${eur(kist)}`);
                    schritte.push(`Netto: ${eur(brutto)} − ${eur(summe)} − ${eur(lohnsteuer)}${kistSatz ? ' − ' + eur(kist) : ''} = <strong>${eur(netto)}</strong>`);
                }
                schritte.push('Die Unfallversicherung zahlt der Arbeitgeber allein – sie taucht in der Gehaltsabrechnung nicht als Abzug auf.');
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, schritte.map((s) => h('li', { html: s }))));
            }
        };
    }

    // ---------- Lernkarten ----------

    const LERNEN = {
        faelle: `
            <h4>So gehst du an einen Fall heran</h4>
            <ol>
                <li><strong>Wer ist beteiligt?</strong> Azubi oder Fachkraft, Arbeitgeber oder Arbeitnehmer, Verbraucher oder Unternehmer, jugendlich oder volljährig – davon hängt fast immer ab, welche Regel gilt.</li>
                <li><strong>Welches Gesetz passt?</strong> Ordne den Fall einem Rechtsgebiet zu (Tabelle unten).</li>
                <li><strong>Gibt es eine Besonderheit?</strong> Probezeit, Schwangerschaft, Betriebsrat vorhanden, Betrieb mit mehr als 10 Beschäftigten …</li>
                <li><strong>Antworten kritisch lesen:</strong> Wörter wie „immer“, „nie“ oder „jederzeit“ sind oft ein Hinweis auf eine falsche Antwort.</li>
            </ol>
            <h4>Die wichtigsten Gesetze</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Gesetz</th><th>regelt</th><th>typische Prüfungsthemen</th></tr></thead>
                <tbody>
                    <tr><td>BBiG</td><td>Berufsausbildung</td><td>Probezeit 1–4 Monate, Kündigung, Pflichten, Berichtsheft, Vergütung</td></tr>
                    <tr><td>JArbSchG</td><td>Beschäftigte unter 18</td><td>8 Std./Tag, 40 Std./Woche, Pausen 30/60 Min., 25–30 Werktage Urlaub</td></tr>
                    <tr><td>ArbZG</td><td>Arbeitszeit Erwachsener</td><td>8 (max. 10) Std./Werktag, Pausen 30/45 Min., 11 Std. Ruhezeit</td></tr>
                    <tr><td>BGB</td><td>Verträge allgemein</td><td>Arbeitsvertrag, Kündigungsfristen (§ 622), Schriftform (§ 623), Kaufvertrag, Verzug, Verjährung</td></tr>
                    <tr><td>KSchG</td><td>Kündigungsschutz</td><td>mehr als 10 Beschäftigte, mehr als 6 Monate im Betrieb, Klage binnen 3 Wochen</td></tr>
                    <tr><td>BetrVG</td><td>Betriebsrat</td><td>Wahl ab 5 Beschäftigten, Wahlrecht ab 16, Anhörung vor Kündigungen, Mitbestimmung</td></tr>
                    <tr><td>MuSchG, BEEG</td><td>Mutterschutz, Elternzeit</td><td>Schutzfristen 6 + 8 Wochen, Kündigungsverbot, Elternzeit bis 3 Jahre</td></tr>
                    <tr><td>BUrlG</td><td>Urlaub</td><td>24 Werktage Mindesturlaub, 6 Monate Wartezeit</td></tr>
                    <tr><td>HGB</td><td>Kaufleute</td><td>Prokura, Handlungsvollmacht, Handelsregister</td></tr>
                    <tr><td>DSGVO</td><td>Datenschutz</td><td>Rechtsgrundlage, Einwilligung, Auskunftsrecht</td></tr>
                    <tr><td>ArbSchG</td><td>Arbeitsschutz</td><td>Gefährdungsbeurteilung, Unterweisung</td></tr>
                </tbody>
            </table></div>
            <p class="game-merke">Nach einer falschen Antwort bekommst du einen Denkanstoß zum Themengebiet. Die Lösung erklärt immer auch, warum die richtige Antwort stimmt – lies sie, auch wenn du richtig lagst.</p>`,

        fakten() {
            const gruppen = {};
            FAKTEN.forEach((x) => { (gruppen[x.g] = gruppen[x.g] || []).push(x); });
            return h('div', {},
                h('p', {}, 'Diese Zahlen kommen in WiSo-Prüfungen immer wieder vor. Lies sie dir hier in Ruhe durch – im Spiel werden sie dann abgefragt, dazu eine Verjährungsfrage.'),
                Object.entries(gruppen).map(([gruppe, liste]) => [
                    h('h4', {}, gruppe),
                    h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered' },
                        h('tbody', {}, liste.map((x) => h('tr', {},
                            h('td', {}, x.f),
                            h('td', { class: 'text-nowrap fw-semibold' }, deFormat(x.a, 0) + ' ' + x.e),
                            h('td', { class: 'small text-muted' }, x.i))))))
                ]),
                h('h4', {}, 'Verjährung berechnen'),
                h('p', { html: 'Die regelmäßige Verjährung (3 Jahre) beginnt erst <strong>mit dem Schluss des Jahres</strong>, in dem der Anspruch entstanden ist. Das genaue Datum im Jahr spielt also keine Rolle.' }),
                h('p', { class: 'game-example', html: 'Rechnung fällig am 10.03.2025 → Fristbeginn 31.12.2025 → Verjährung mit Ablauf des <strong>31.12.2028</strong>.' }));
        },

        kuendigung: `
            <h4>Welche Frist gilt?</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Situation</th><th>Frist</th><th>Endtermin</th></tr></thead>
                <tbody>
                    <tr><td>Arbeitsverhältnis in einer vereinbarten Probezeit (höchstens 6 Monate)</td><td>2 Wochen</td><td>jeder Tag</td></tr>
                    <tr><td><strong>Grundkündigungsfrist</strong> (§ 622 Abs. 1 BGB) – gilt, wenn der <strong>Arbeitnehmer</strong> kündigt, und für den Arbeitgeber in den ersten 2 Jahren</td><td>4 Wochen</td><td>zum 15. oder zum Monatsende</td></tr>
                    <tr><td><strong>Arbeitgeber</strong> kündigt nach 2 / 5 / 8 / 10 / 12 / 15 / 20 Jahren Betriebszugehörigkeit (§ 622 Abs. 2 BGB)</td><td>1 / 2 / 3 / 4 / 5 / 6 / 7 Monate</td><td>zum Monatsende</td></tr>
                    <tr><td>Ausbildung während der Probezeit (§ 22 Abs. 1 BBiG)</td><td>keine</td><td>sofort mit Zugang</td></tr>
                    <tr><td>Ausbildung nach der Probezeit: Azubi gibt die Ausbildung auf oder wechselt den Beruf (§ 22 Abs. 2 BBiG)</td><td>4 Wochen</td><td>jeder Tag</td></tr>
                    <tr><td>Ausbildung nach der Probezeit: Betrieb kündigt</td><td colspan="2">nur fristlos aus wichtigem Grund</td></tr>
                    <tr><td>Fristlose Kündigung aus wichtigem Grund (§ 626 BGB)</td><td>keine</td><td>sofort – erklären innerhalb von 2 Wochen nach Kenntnis</td></tr>
                </tbody>
            </table></div>
            <p class="game-merke">Bei der Grundfrist und den verlängerten Fristen endet das Arbeitsverhältnis immer am 15. oder am Monatsende. Ein Ende am 12. oder 23. ist nur möglich, wenn die Frist keinen festen Termin hat: in der Probezeit, in der Ausbildung oder bei einer fristlosen Kündigung.</p>
            <h4>So rechnest du vorwärts</h4>
            <ol>
                <li><strong>Zugang bestimmen:</strong> Die Frist läuft ab dem Tag, an dem die Kündigung zugeht (z. B. im Briefkasten liegt) – nicht ab dem Datum auf dem Schreiben.</li>
                <li><strong>Frist ab dem Folgetag zählen:</strong> 2 Wochen = 14 Tage, 4 Wochen = 28 Tage. Das Fristende fällt deshalb auf denselben Wochentag wie der Zugang. Monatsfristen enden am gleichen Kalendertag n Monate später (gibt es den Tag nicht, am letzten Tag des Monats).</li>
                <li><strong>Auf den Endtermin aufrunden:</strong> Grundfrist → nächster 15. oder nächstes Monatsende; verlängerte Frist → nächstes Monatsende; Fristen ohne Termin → das Fristende ist das Ende.</li>
                <li>Wochenenden und Feiertage verschieben nichts.</li>
            </ol>
            <p class="game-example">Zugang Mittwoch, 04.03.2026, Grundfrist: 04.03. + 28 Tage = Mittwoch, 01.04.2026. Nächster zulässiger Termin: <strong>15.04.2026</strong>.<br>
            Arbeitgeber nach 9 Jahren (3 Monate), Zugang 20.01.2026: + 3 Monate = 20.04.2026 → Monatsende: <strong>30.04.2026</strong>.</p>
            <h4>So rechnest du rückwärts („Bis wann muss die Kündigung zugehen?“)</h4>
            <ul>
                <li>Grundfrist: <strong>Termin minus 28 Tage</strong> – zum 31.05. also spätestens am 03.05., zum 15.06. spätestens am 18.05.</li>
                <li>n Monate zum Monatsende: spätestens am <strong>letzten Tag des Monats, der n Monate vor dem Termin liegt</strong> – 3 Monate zum 30.09. also spätestens am 30.06.</li>
            </ul>
            <h4>Außerdem wichtig</h4>
            <ul>
                <li>Jede Kündigung braucht die <strong>Schriftform</strong> mit eigenhändiger Unterschrift (§ 623 BGB) – E-Mail, Fax oder Messenger reichen nicht.</li>
                <li>Arbeits- oder Tarifverträge können längere Fristen vereinbaren. Für den Arbeitnehmer darf die Frist aber nie länger sein als für den Arbeitgeber.</li>
                <li>Ist ein Betriebsrat vorhanden, muss er vor jeder Kündigung durch den Arbeitgeber angehört werden.</li>
            </ul>`,

        urlaub: `
            <h4>Wie viel Urlaub steht mindestens zu?</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Alter zu Beginn des Kalenderjahres</th><th>Werktage</th><th>Gesetz</th></tr></thead>
                <tbody>
                    <tr><td>noch nicht 16</td><td>30</td><td rowspan="3">§ 19 JArbSchG</td></tr>
                    <tr><td>noch nicht 17</td><td>27</td></tr>
                    <tr><td>noch nicht 18</td><td>25</td></tr>
                    <tr><td>volljährig</td><td>24</td><td>§ 3 BUrlG</td></tr>
                </tbody>
            </table></div>
            <p class="game-merke">Es zählt das Alter am 1. Januar. Wer am 01.01. noch 16 ist, bekommt das ganze Jahr 27 Werktage – auch wenn im März der 17. Geburtstag kommt.</p>
            <h4>Werktage oder Arbeitstage?</h4>
            <p>Das Gesetz rechnet mit <strong>Werktagen</strong> (Montag bis Samstag, also einer 6-Tage-Woche). Wer an weniger Tagen arbeitet, rechnet um:</p>
            <p class="game-example">Urlaub in Arbeitstagen = Werktage · Arbeitstage pro Woche / 6<br>24 Werktage bei 5-Tage-Woche: 24 · 5 / 6 = <strong>20 Arbeitstage</strong> · 25 Werktage: 25 · 5 / 6 = <strong>20,83 Arbeitstage</strong></p>
            <h4>Wartezeit und Teilurlaub</h4>
            <ul>
                <li>Den <strong>vollen</strong> Jahresurlaub gibt es erst nach 6 Monaten im Betrieb (§ 4 BUrlG). Endet die Wartezeit noch im Eintrittsjahr (Eintritt bis 1. Juli), steht der volle Urlaub schon im ersten Jahr zu.</li>
                <li>Endet die Wartezeit erst im nächsten Jahr, gibt es für das Eintrittsjahr <strong>Teilurlaub</strong>: 1/12 des Jahresurlaubs für jeden vollen Monat (§ 5 BUrlG).</li>
                <li>Beim Teilurlaub werden Bruchteile von mindestens einem halben Tag auf einen vollen Tag <strong>aufgerundet</strong>.</li>
            </ul>
            <p class="game-example">Eintritt 01.09., 26 Urlaubstage im Jahr: September bis Dezember = 4 volle Monate → 26 · 4 / 12 = 8,67 → aufgerundet <strong>9 Tage</strong>.</p>`,

        sv: `
            <h4>Die fünf Zweige der Sozialversicherung</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Zweig</th><th>Beitragssatz (2026)</th><th>Wer zahlt?</th><th>Träger</th></tr></thead>
                <tbody>
                    <tr><td>Krankenversicherung</td><td>14,6 % + Zusatzbeitrag der Kasse (Ø 2,9 %)</td><td>je zur Hälfte</td><td>Krankenkasse</td></tr>
                    <tr><td>Pflegeversicherung</td><td>3,6 % + 0,6 % Zuschlag für Kinderlose ab 23</td><td>je zur Hälfte, den Zuschlag zahlt der Arbeitnehmer allein</td><td>Pflegekasse</td></tr>
                    <tr><td>Rentenversicherung</td><td>18,6 %</td><td>je zur Hälfte</td><td>Deutsche Rentenversicherung</td></tr>
                    <tr><td>Arbeitslosenversicherung</td><td>2,6 %</td><td>je zur Hälfte</td><td>Bundesagentur für Arbeit</td></tr>
                    <tr><td>Unfallversicherung</td><td>je nach Gefahrenklasse</td><td>Arbeitgeber allein</td><td>Berufsgenossenschaft</td></tr>
                </tbody>
            </table></div>
            <h4>So rechnest du den Arbeitnehmeranteil</h4>
            <p>Arbeitnehmeranteil = Bruttogehalt · halber Beitragssatz (bei der Pflegeversicherung ggf. plus Kinderlosenzuschlag). Jeden Beitrag auf Cent runden.</p>
            <p class="game-example">3.000 € brutto, kinderlos, Zusatzbeitrag 2,9 %:<br>
            KV: 3.000 € · (14,6 % + 2,9 %) / 2 = 3.000 € · 8,75 % = 262,50 €<br>
            PV: 3.000 € · (1,8 % + 0,6 %) = 72,00 €<br>
            RV: 3.000 € · 9,3 % = 279,00 € · AV: 3.000 € · 1,3 % = 39,00 €<br>
            Summe: <strong>652,50 €</strong></p>
            <h4>Vom Brutto zum Netto</h4>
            <p>Netto = Brutto − Lohnsteuer − Solidaritätszuschlag (nur bei hohen Einkommen) − Kirchensteuer (8 % oder 9 % der Lohnsteuer) − Arbeitnehmeranteile zur Sozialversicherung.</p>
            <p class="game-merke">Die Beitragssätze ändern sich fast jedes Jahr. In Prüfungsaufgaben werden sie deshalb angegeben – wichtig ist, dass du den Rechenweg sicher beherrschst.</p>`
    };

    const modes = [
        { id: 'faelle', name: 'Fallentscheidungen', icon: 'bi-briefcase', levels: false, description: 'Kurze Fälle aus Ausbildung, Arbeitsrecht, Kaufvertrag und Wirtschaft.', learn: LERNEN.faelle, create: ({ rng }) => fallAufgabe(rng) },
        { id: 'fakten', name: 'Zahlen & Fristen', icon: 'bi-stopwatch', levels: false, learn: LERNEN.fakten, create: ({ rng }) => faktenAufgabe(rng) },
        { id: 'kuendigung', name: 'Kündigungsfristen', icon: 'bi-calendar-x', learn: LERNEN.kuendigung, create: ({ rng, level }) => kuendigungsAufgabe(rng, level) },
        { id: 'urlaub', name: 'Urlaubsanspruch', icon: 'bi-sun', learn: LERNEN.urlaub, create: ({ rng, level }) => urlaubsAufgabe(rng, level) },
        { id: 'sv', name: 'Sozialversicherung', icon: 'bi-shield-plus', learn: LERNEN.sv, create: ({ rng, level }) => svAufgabe(rng, level) }
    ];

    window.WisoTrainer = { modes, FAELLE, FAKTEN, THEMEN, plusMonate, monatsende, plusTage, datum, grundfrist, monatsfrist, kuendigungsFall, FALLTYPEN, REGELN };

    const root = document.getElementById('wiso-game');
    if (root) window.ITGame.mount(root, { id: 'wiso', modes });
})();
